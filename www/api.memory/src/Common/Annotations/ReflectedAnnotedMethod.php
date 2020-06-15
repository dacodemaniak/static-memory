<?php
namespace Memory\Common\Annotations;

/**
 * @name ReflectedAnnotedMethod
 * @author IDea Factory (jean-luc.a@ideafactory.fr) - June 2020
 * @version 1.0.0
 * @namespace Memory\Common\Annotations
 * @abstract Extract annotations from class methods
 */

final class ReflectedAnnotedMethod extends \ReflectionMethod {

    /**
     * Comments for the current reflected method
     * @var string
     */
    private $rawComment = "";
    
    /**
     * Collection of annotations found
     * @var array
     */
    private $annotations;
    
    public function __construct(string $className, string $classMethod) {
        parent::__construct($className, $classMethod);
        
        $this->parse();
    }
    
    /**
     * Returns raw comment for the current reflected method
     * @return string
     */
    public function getRawComment(): string {
        return $this->rawComment;
    }
    
    public function getAnnotations(): array {
        return $this->annotations;
    }
    
    /**
     * Check if an annotation is present for the current method
     * @param string $annotation
     * @return boolean
     */
    public function hasAnnotation(string $annotation): bool {
        return array_key_exists("@" . $annotation, $this->annotations);
    }
    
    private function parse(): void {
        $this->rawComment = trim(
            str_replace(
                [
                    "/**",
                    "*/",
                    "*",
                    "\t",
                    " "
                ],
                "",
                $this->getDocComment()
           )
       );
        
       // Loop throw remaining string
       $annotation = "";
       $content = "";
       $followAnnotation = false;
       $followContent = false;
        for ($i = 0; $i < strlen($this->rawComment); $i++) {
            $char = $this->rawComment[$i];
            
            if ($char === "@") {
                // Need to know if we get a "("
                $followAnnotation = true;
                $followContent = false;
            } else {
                if ($char === "\n") continue;
            }
            
            if ($followAnnotation) {
                if ($char === "\n") continue;
                
                if ($char === "(") {
                    // Got an annotation
                    $this->annotations[$annotation] = [];
                    
                    // Follow the content
                    $followContent = true;
                    $followAnnotation = false;
                    continue;
                } else {
                    $annotation .= $char;
                }
            }
            
            if ($followContent) {
                if ($char === "\n") continue;
                
                if ($char === ")") {
                    // Content down
                    $this->annotations[$annotation] = $content;
                    $this->followContent = false;
                    $this->followAnnotation = false;
                    $annotation = "";
                    $content = "";
                } else {
                    $content .= $char;
                }
                
            }
        }
    }
}

