<?php


namespace App\Utils;


class FlashMessages
{

    /**
     * @param string $entity
     * @param string $actionSuccessed
     * @return string
     */
    public static function createSuccessMessage(string $entity, string $actionSuccessed) : string
    {
        return 'Votre ' . mb_strtolower($entity) . ' a bien été ' . mb_strtolower($actionSuccessed);
    }

    /**
     * @param string $entity
     * @param string $actionSuccessed
     * @return string
     */
    public static function createFailledMessage(string $entity, string $actionSuccessed) : string
    {
        return 'Votre ' . mb_strtolower($entity) . " n'a pas pu être " . mb_strtolower($actionSuccessed);
    }

}