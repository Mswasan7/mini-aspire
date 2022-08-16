<?php
/** Common data transfer for all */
namespace App\Http\DataTransferObjects;


use Carbon\Carbon;
use Spatie\DataTransferObject\FlexibleDataTransferObject;
/**
 * GeneralFlexibleDataTransferObject is a command parent class for all collections
 */
abstract class GeneralFlexibleDataTransferObject extends FlexibleDataTransferObject
{
    /**
     * Used to Format Date
     *
     * @param $property
     * @param $parameters
     * @param string $format
     */
    public function formatDate($property, $parameters, string $format = 'Y-m-d H:i:s')
    {
        $this->{$property} = ($parameters[$property]) ? Carbon::parse($parameters[$property])->format($format) : $parameters[$property];
    }

    /**
     * it will translate ID to guid
     * @param $parameters
     */
    public function transitIdToGuid($parameters)
    {
        $prop = 'id'; // to avoid IDEError

        $this->{$prop} = $parameters['guid'] ?? $parameters['id'];
    }

    /**
     * To set property from Props
     *
     * @param array $parameters
     * @param array $propsToBeSet
     */
    public function setPropertiesFromProps(array $parameters, array $propsToBeSet)
    {
        $decoded = json_decode($parameters['props'], true);

        foreach ($propsToBeSet as $prop) {
            if ( isset($decoded[$prop]) ) {
                $this->{$prop} = $decoded[$prop];
            }
        }
    }

    /**
     * To set property as label and id from whole key
     *
     * @param array $parameters
     * @param array $propsToBeSet
     */
    public function setPropertiesAsLabelAndId(array $parameters, array $propsToBeSet)
    {
        foreach ($propsToBeSet as $key => $prop) {
            if ( isset($parameters[$key]) && $parameters[$key][$prop['id']] && $parameters[$key][$prop['label']] ) {
                $this->{$key} = [
                    'id'    => $parameters[$key][$prop['id']],
                    'label' => $parameters[$key][$prop['label']],
                ];
            }
        }
    }
}

