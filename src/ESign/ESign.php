<?php

namespace ESign;

use ESign\District\Common;
use ESign\District\District;
use ESign\District\Template;
use ESign\Http\Request;
use ESign\Http\Response;
use Exception;

/**
 * Class ESign
 * @method uploadUrl(string $dist)
 * @method Response createByFile(string $fileDir)
 * @package ESign
 */
class ESign
{

    protected $config;

    /**
     * @var Common $common
     */

    protected $district = [];

    private $map = [];

    /**
     * @throws Exception
     */
    public function __construct($options)
    {
        $this->config = new Config($options['appid'] ?? '', $options['secret'] ?? '', $options['host'] ?? '');;
        $this->mapping();
    }


    /**
     * 设置方法映射
     * @throws Exception
     */
    protected function mapping()
    {
        $classes = [
            Template::class
        ];

        foreach ($classes as $class) {
            $methods = get_class_methods($class);
            $classMethods = array_combine($methods, array_fill(0, count($methods), $class));

            $intersect = array_intersect($this->map, $classMethods);
            if ($intersect) {
                throw new Exception("class $class has intersect " . array_keys($intersect)[0]);
            }
            $this->map = array_merge($this->map, $classMethods);
        }

    }

    /**
     * 方法->对象实例
     * @throws Exception
     */
    private function resolve($method)
    {
        if (!key_exists($method, $this->map)) {
            throw new Exception('method ' . $method . ' not found');
        }
        $class = $this->map[$method];

        if (!key_exists($class, $this->district)) {
            $this->district[$class] = new $class;
        }

        return $this->district[$class];
    }


    /**
     * 请求
     * @param District $district
     * @return Response
     */
    public function handle(District $district): Response
    {
        $district->setBaseUrl($this->config->getHost());

        return (new Request())->request($this->config, $district);
    }

    /**
     * @throws Exception
     */
    public function __call($name, $arguments)
    {
        $class = $this->resolve($name);
        $class->$name(...$arguments);
        return $this->handle($class);
    }
}
