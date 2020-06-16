<?php
namespace Memory\Common\Annotations;

class AltoRoute {
    /**
     * Route name
     * @var string
     */
    public $name;
    
    /**
     * Route path
     * @var string
     */
    public $path;
    
    /**
     * Route Http Method
     * @var string
     */
    public $httpMethod;
    
    /**
     * Full qualified class name handled
     * @var string
     */
    public $className;
    
    /**
     * Class method concerned
     * @var string
     */
    public $classMethod;
    
    /**
     * Properties separator to split content
     * @var string
     */
    private static $propertiesSeparator = ",";
    
    /**
     * Value separator to get class property and associated value
     * @var string
     */
    private static $valueSeparator = "=";
    
    public function __construct(string $className, string $classMethod) {
        $this->path = "/";
        $this->name = "/home";
        $this->httpMethod = "GET";
        
        $this->className = $className;
        $this->classMethod = $classMethod;
    }
    
    /**
     * Parse Annotation content to hydrate properties
     * @param string $content
     */
    public function parse(string $content): void {
        // Beautify content
        $content = trim(str_replace([" ", "\""], "", $content));
        
        // Split content on separator
        $properties = explode(self::$propertiesSeparator, $content);
        
        
        // Loop through Properties to hydrate class properties
        foreach ($properties as $property) {
            $values = explode(self::$valueSeparator, $property);
            if (property_exists($this, $values[0])) {
                $this->{$values[0]} = $values[1];
            }
        }
    }
}

