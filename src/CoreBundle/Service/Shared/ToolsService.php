<?php

namespace CoreBundle\Service\Shared;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use \FOS\RestBundle\View\View;
class ToolsService {

    /**
     *
     * @param string $data
     * @param string $className
     * @param string $format
     * @return object|null
     */
    public function deserialize(string $data, string $className, string $format = 'json'): ?object {
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        $object = $serializer->deserialize($data, $className, $format);
        return $object;
    }

    /**     
     *
     * @param string $message
     * @param integer $codeHttp
     * @return View
     */
    public function responseHttp(string $message, int $codeHttp): View {        	
        return View::create(['message' => $message, 'code' => $codeHttp]);
    }
}