<?php

namespace App\Http\Controllers\Api\Base\Interfaces;

use Exception;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;
use JsonSerializable;
use Illuminate\Contracts\Support\Jsonable;
use ReturnTypeWillChange;

abstract class DataInterface implements Jsonable, JsonSerializable, Arrayable
{
    /**
     * Convert the object to its JSON representation.
     *
     * @param int $options
     * @return string
     */
    public function toJson($options = 0)
    {
        return json_encode($this->jsonSerialize());
    }

    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return array data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4
     */
    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray(): array|null
    {
        return DataInterface::convertToArray($this);
    }

    public static function convertToArray($object): array|null
    {
        if (is_array($object) || is_object($object)) {
            $result = [];
            foreach ($object as $key => $value) {
                $result[$key] = (is_array($value) || is_object($value)) ? DataInterface::convertToArray($value) : $value;
            }
            return is_object($object) && $result == [] ? null : $result;
        }
        return $object;
    }

    /**
     * @throws Exception
     */
    public static function validate($data)
    {
        if (!DataInterface::valid($data)) {
            throw new Exception("Response data type must be a DataInterface class or a class that extends DataInterface");
        }
    }

    private static function valid($data): bool
    {
        if ($data instanceof Collection) {
            return DataInterface::isValidCollection($data);
        }
        if (is_array($data)) {
            return DataInterface::isValidArray($data);
        }
        return DataInterface::isValidObject($data);
    }

    public static function isValidArray($object): bool
    {
        foreach ($object as $property) {
            if (!$property instanceof DataInterface) {
                return false;
            }
        }
        return true;
    }

    public static function isValidCollection($data)
    {
        return $data->every(function ($item): bool {
            return $item instanceof DataInterface;
        });
    }

    public static function isValidObject($data): bool
    {
        return $data instanceof DataInterface;
    }
}
