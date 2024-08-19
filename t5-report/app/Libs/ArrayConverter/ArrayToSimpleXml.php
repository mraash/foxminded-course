<?php

declare(strict_types=1);

namespace App\Libs\ArrayConverter;

use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Serializer;

class ArrayToSimpleXml implements ArrayToViewInterfact
{
    private const ARRAY_ITEM_TAG = 'item';

    /**
     * @param array<string,mixed> $array  Data to encode.
     *
     * Note: Method will process only first item of $array (as xml root element). So if you will
     *   pass array with more than one item, they will be ignored.
     */
    public function encode(array $array): string
    {
        $rootElement = array_key_first($array);
        $childs = $array[$rootElement];
        $childElements = is_array($childs) ? self::wrapIndexedArrays($childs) : $childs;

        $normalizers = [];
        $encoders = [new XmlEncoder(['xml_root_node_name' => $rootElement])];

        $serializer = new Serializer($normalizers, $encoders);

        return $serializer->encode($childElements, 'xml');
    }

    /**
     * Will wrap [a, b, c] to ['item' => [a, b, c]], so Symfony\Component\Serializer\Encoder\XmlEncoder
     *   will give outpu <item>a</item> <item>b</item> ...
     *
     * @param mixed[] $array
     *
     * @return mixed[]
     */
    private static function wrapIndexedArrays(array $array): array
    {
        $result = [];

        foreach ($array as $key => $item) {
            if (!is_array($item)) {
                $result[$key] = self::stringifyPrimitive($item);
                continue;
            }

            if (self::isArrayAssociative($item)) {
                $result[$key] = self::wrapIndexedArrays($item);
                continue;
            }

            $result[$key] = [ self::ARRAY_ITEM_TAG => self::wrapIndexedArrays($item) ];
        }

        return $result;
    }

    /**
     * @param mixed[] $array
     */
    private static function isArrayAssociative(array $array): bool
    {
        $iteration = 0;

        foreach ($array as $key => $value) {
            if ($key !== $iteration) {
                return true;
            }

            $iteration++;
        }

        return false;
    }

    private static function stringifyPrimitive(mixed $value): string
    {
        if (is_bool($value)) {
            return $value === true ? 'true' : 'false';
        }

        return strval($value);
    }
}
