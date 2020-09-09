<?php

namespace SimpleFactory;

use Exception;

interface IRuleConfigParser
{
    public function parser(string $configText);
}

class JsonRuleConfigParser implements IRuleConfigParser
{
    public function parser(string $configText)
    {

    }
}

class XmlRuleConfigParser implements IRuleConfigParser
{
    public function parser(string $configText)
    {

    }
}

class YamlRuleConfigParser implements IRuleConfigParser
{
    public function parser(string $configText)
    {

    }
}

class PropertiesRuleConfigParser implements IRuleConfigParser
{
    public function parser(string $configText)
    {

    }
}


class RuleConfigSource
{
    public function load(string $ruleConfigFilePath)
    {
        $ruleConfigFileExtension = $this->getFileExtension($ruleConfigFilePath);
        $parser                  = RuleConfigParserFactory::createParser($ruleConfigFileExtension);
        if ($parser === null) {
            throw new Exception("Rule config file format is not supported: " . $ruleConfigFileExtension);
        }
        $configText = "";
        //从ruleConfigFilePath文件中读取配置文本到configText中
        $parser->parser($configText);

        if ($parser instanceof JsonRuleConfigParser) {
            echo "is JsonRuleConfigParser";
        }
    }


    private function getFileExtension(string $filePath)
    {
        //...解析文件名获取扩展名，比如rule.json，返回json
        return "json";
    }
}

//class RuleConfigParserFactory
//{
//    public static function createParser(string $configFormat)
//    {
//        $parser = null;
//
//        if (strpos("json", $configFormat) !== false) {
//            $parser = new JsonRuleConfigParser();
//        } else if (strpos("xml", $configFormat) !== false) {
//            $parser = new XmlRuleConfigParser();
//        } else if (strpos("yaml", $configFormat) !== false) {
//            $parser = new YamlRuleConfigParser();
//        } else if (strpos("properties", $configFormat) !== false) {
//            $parser = new PropertiesRuleConfigParser();
//        }
//        return $parser;
//    }
//
//}


class RuleConfigParserFactory
{
    private static $cacheParsers;

    private static function initCacheParser()
    {
        if (self::$cacheParsers == null) {
            self::$cacheParsers = [
                "json"       => new JsonRuleConfigParser(),
                "xml"        => new XmlRuleConfigParser(),
                "yaml"       => new YamlRuleConfigParser(),
                "properties" => new PropertiesRuleConfigParser(),
            ];
        }
    }

    public static function createParser(string $configFormat){
        self::initCacheParser();
        if ($configFormat == null || empty($configFormat)) {
            //返回null还是IllegalArgumentException全凭你自己说了算
            return null;
        }
        $parser =self::$cacheParsers[$configFormat];
        return $parser;
    }

}

$configSource = new RuleConfigSource();
$configSource->load("path");
