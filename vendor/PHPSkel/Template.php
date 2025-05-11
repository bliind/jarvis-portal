<?php

namespace PHPSkel;

class Template
{
    protected $templateDir = ROOTDIR . '/templates/';
    protected $compiledTemplateDir = ROOTDIR . '/templates/compiled/';

    protected $compiledFile;

    /**
     * Determines whether or not the compiled template is good to use or needs to be compiled
     * 
     * @param string $templateName
     */
    public function __construct(string $templateName)
    {
        $templateFile = $this->templateDir . $templateName;
        $newName = pathinfo($templateName, PATHINFO_FILENAME) . '.php';
        $this->compiledFile = $this->compiledTemplateDir . $newName;

        // die if no template
        if (!file_exists($templateFile)) {
            throw new \Exception('No such template: ' . $templateName);
        }

        $this->compileTemplate($templateName);
        return;

        // compile if compiled doesn't exist
        if (!file_exists($this->compiledFile)) {
            $this->compileTemplate($templateName);
        }

        // make list of files to compare compiled file mtime to
        $files = [$templateFile];
        $compiledmtime = filemtime($this->compiledFile);
        // get all files from extend or include lines
        $this->getAllExtendInclude($templateName, $files);
        foreach ($files as $file) {
            $this->getAllExtendInclude(str_replace($this->templateDir, '', $file), $files);
        }

        // check mtime of each file against compiled file mtime
        foreach ($files as $file) {
            if (filemtime($file) > $compiledmtime) {
                // if any are newer, recompile and stop looping
                $this->compileTemplate($templateName);
                break;
            }
        }
    }

    private function getAllExtendInclude($templateName, &$files)
    {
        $lines = $this->getSplitTemplate($templateName);
        foreach ($lines as $line) {
            preg_match('/{% (extends|include) "(.+)" %}/', $line, $matches);
            if ($matches && count($matches) > 2) {
                $files[] = $this->templateDir . $matches[2];
            }
        }
    }

    /**
     * Gets a template and splits it line by line
     * 
     * @param string $templateName
     * @return array
     */
    protected function getSplitTemplate(string $templateName)
    {
        $template = file_get_contents($this->templateDir . $templateName);

        return preg_split('/(\r?\n|\r\n?)/', $template);
    }

    /**
     * Flattens an array of blocks into one string using recursion
     * 
     * @param array $block
     * @param string $string
     */
    protected function flattenBlock(array $block, string &$string = '')
    {
        foreach ($block as $line) {
            if (is_array($line)) {
                $this->flattenBlock($line, $string);
            } else {
                $string .= $line . PHP_EOL;
            }
        }
    }

    /**
     * Compiles a template replacing {{ $var }} syntax with <?= $var ?>
     * and {{ if ($something) }} to <?php if ($something) ?>
     * 
     * @param string $filename
     */
    protected function compileTemplate(string $filename)
    {
        // get the template file as an array of lines
        $template = $this->getSplitTemplate($filename);

        // make blocks from this template
        $blocks = $this->makeBlocks($template, []);

        // turn blocks into one big string
        $template = '';
        $this->flattenBlock($blocks, $template);

        // make sure the directory structure exists
        $compiledDir = dirname($this->compiledFile);
        if (!file_exists($compiledDir)) {
            mkdir($compiledDir, 0755, true);
        }

        if ($template) {
            // write the compiled file
            file_put_contents($this->compiledFile, $template);
        }
    }

    /**
     * Creates blocks of HTML according to the markup
     */
    protected function makeBlocks(array $template, array $blocks = [])
    {
        $output = &$blocks;
        $blockChain = [];
        
        foreach ($template as $index => $line) {
            // match non-variable expression (block, extends, etc)
            if (preg_match('/{%(\s+)?(\w+)(\s+)?[\'"]?([\w\/\.-]+)?[\'"]?(\s+)?%}/', $line, $matches)) {
                $methodName = 'function' . ucwords($matches[2]);
                if (method_exists($this, $methodName)) {
                    $this->$methodName($blocks, $blockChain, $output, @$matches[4], $index);

                    // the method may change the block chain so we'll reset and follow to the end
                    $output = &$blocks;
                    foreach ($blockChain as $link) {
                        $output = &$output[$link];
                    }

                    continue;
                }
            }

            // parse any other line for a php expression
            $output[] = $this->parseVars($line);
        }

        return $blocks;
    }

    /**
     * The function to run when a 'block' is come across
     */
    protected function functionBlock(array $blocks, array &$blockChain, array $output, $blockName)
    {
        // add to the chain, initialize block
        $blockChain[] = $blockName;
        $output[$blockName] = [];
    }

    /**
     * The function to run when an 'extend_block' is come across
     */
    protected function functionExtend_block(array $blocks, array &$blockChain, array $output, $blockName)
    {
        // add to the chain
        $blockChain[] = $blockName;

        // only initialize block if it doesn't exist, otherwise we will append
        if (!isset($output[$blockName])) {
            $output[$blockName] = [];
        }
    }

    /**
     * The function to run with an 'endblock' is come across
     */
    protected function functionEndblock(array $blocks, array &$blockChain, $output)
    {
        // remove the latest block from the chain
        array_pop($blockChain);
    }

    /**
     * The function to run when an "extends" is come across
     */
    protected function functionExtends(array &$blocks, array $blockChain, array $output, $template, $index)
    {
        if ($index !== 0) {
            throw new \Exception('Can only extend at the beginning of a template');
        }

        $parentTemplate = $this->getSplitTemplate($template);

        // we'll create the blocks from the parent
        $blocks = $this->makeBlocks($parentTemplate, []);
    }

    /**
     * The function to run when an "include" is come across
     */
    protected function functionInclude(array &$blocks, array $blockChain, array $output, $template, $index)
    {
        $includeTemplate = $this->getSplitTemplate($template);
        $includeBlocks = $this->makeBlocks($includeTemplate, []);
        if (!empty($blockChain)) {
            // if we are inside a block, as made evident by the existence of an element inside $blockChain,
            // merge the $includeBlocks with that specific $block
            $blocks[end($blockChain)] = array_merge($blocks[end($blockChain)], $includeBlocks);
        } else {
            // or else we just merge to the end of $blocks
            $blocks = array_merge($blocks, $includeBlocks);
        }
    }

    /**
     * Handles parsing a template line into PHP
     * 
     * @param string $line
     * @return string
     */
    protected function parseVars(string $line)
    {
        // if we don't have a template expression here, just return the line
        if (strpos($line, '{%') === false) {
            // handle comments
            // inline comment
            preg_match_all('/({\*.+\*})/', $line, $commentMatch);
            if ($commentMatch) {
                $line = str_replace($commentMatch[0], '', $line);
            }

            return $line;
        }

        // replace variables to look in the encapsulated pageVars
        preg_match_all('/\$\w+/', $line, $vars);
        foreach ($vars[0] as $var) {
            $line = preg_replace('/' . preg_quote($var) . '/', '$pageVariables[\'' . substr($var, 1) . '\']', $line, 1);
        }

        // split each expression in the line
        preg_match_all('/\\{%?((?!%\\}).)+%\\}/', $line, $matches, PREG_PATTERN_ORDER);
        $expressions = [];
        foreach ($matches as $match) {
            $expressions = array_merge($expressions, $match);
        }

        $tags = [
            'normal' => '<?php',
            'echo'   => '<?=',
        ];
        // replace each expression's tags individually
        foreach ($expressions as $expression) {
            $tagType = 'normal';
            // figure out which tags to use for the expression
            $content = trim(str_replace(['{%', '%}'], ['', ''], $expression));
    
            // check for immediate variable
            if (substr($content, 0, 1) === '$' || substr($content, 0, 2) === '@$') {
                $tagType = 'echo';
            }
    
            // check for assignment or comparison
            if (strpos($content, '=') !== false) {
                $tagType = 'normal';
            }
    
            // check for ternary operator
            if (strpos($content, '?') !== false && strpos($content, ':') !== false) {
                $tagType = 'echo';
            }

            // finally replace the tags
            $newExpression = str_replace(['{%', '%}'], [$tags[$tagType], '?>'], $expression);

            // replace the expression in the line
            $line = str_replace($expression, $newExpression, $line);
        }

        return $line;
    }

    /**
     * Gets the compiled content
     */
    protected function getCompiledContent()
    {
        return file_get_contents($this->compiledFile);
    }

    /**
     * Renders the compiled template with the provided variables
     * 
     * @param array $pageVariables
     * @return string
     */
    public function render(array $pageVariables = [])
    {
        ob_start();
        include $this->compiledFile;
        return ob_get_clean();
    }
}
