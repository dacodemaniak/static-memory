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
    
    /**
     * Current full qualified class name
     * @var string
     */
    private $className;
    
    /**
     * Current class method
     * @var string
     */
    private $classMethod;
    
    public function __construct(string $className, string $classMethod) {
        parent::__construct($className, $classMethod);
        
        $this->className = $className;
        $this->classMethod = $classMethod;
        
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
    
    /**
     * Get specific annotation content
     * @param string $annotation
     * @return array
     */
    public function getAnnotation(string $annotation): array {
        if ($this->hasAnnotation($annotation)) {
            return $this->annotations["@" . $annotation];
        }
        
        return [];
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
                    // Content down => check if AnnotationClass exists for this annotation
                    $className = "Memory\\Common\\Annotations\\" . trim(substr($annotation, 1));
                    if (class_exists($className)) {
                        $annotationObject = new $className($this->className, $this->classMethod);
                        $annotationObject->parse($content);
                        $this->annotations[$annotation][] = $annotationObject;
                    } else {
                        // @todo Replace to AnnotationClassNotFound Exception
                        echo "Unable to find class " . $className . "<br>";
                    }
                    
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

