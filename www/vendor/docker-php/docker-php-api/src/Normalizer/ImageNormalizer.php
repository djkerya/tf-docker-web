<?php

declare(strict_types=1);

/*
 * This file has been auto generated by Jane,
 *
 * Do no edit it directly.
 */

namespace Docker\API\Normalizer;

use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ImageNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;

    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === 'Docker\\API\\Model\\Image';
    }

    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof \Docker\API\Model\Image;
    }

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        if (!is_object($data)) {
            return null;
        }
        $object = new \Docker\API\Model\Image();
        if (property_exists($data, 'Id') && $data->{'Id'} !== null) {
            $object->setId($data->{'Id'});
        }
        if (property_exists($data, 'RepoTags') && $data->{'RepoTags'} !== null) {
            $values = [];
            foreach ($data->{'RepoTags'} as $value) {
                $values[] = $value;
            }
            $object->setRepoTags($values);
        }
        if (property_exists($data, 'RepoDigests') && $data->{'RepoDigests'} !== null) {
            $values_1 = [];
            foreach ($data->{'RepoDigests'} as $value_1) {
                $values_1[] = $value_1;
            }
            $object->setRepoDigests($values_1);
        }
        if (property_exists($data, 'Parent') && $data->{'Parent'} !== null) {
            $object->setParent($data->{'Parent'});
        }
        if (property_exists($data, 'Comment') && $data->{'Comment'} !== null) {
            $object->setComment($data->{'Comment'});
        }
        if (property_exists($data, 'Created') && $data->{'Created'} !== null) {
            $object->setCreated($data->{'Created'});
        }
        if (property_exists($data, 'Container') && $data->{'Container'} !== null) {
            $object->setContainer($data->{'Container'});
        }
        if (property_exists($data, 'ContainerConfig') && $data->{'ContainerConfig'} !== null) {
            $object->setContainerConfig($this->denormalizer->denormalize($data->{'ContainerConfig'}, 'Docker\\API\\Model\\ContainerConfig', 'json', $context));
        }
        if (property_exists($data, 'DockerVersion') && $data->{'DockerVersion'} !== null) {
            $object->setDockerVersion($data->{'DockerVersion'});
        }
        if (property_exists($data, 'Author') && $data->{'Author'} !== null) {
            $object->setAuthor($data->{'Author'});
        }
        if (property_exists($data, 'Config') && $data->{'Config'} !== null) {
            $object->setConfig($this->denormalizer->denormalize($data->{'Config'}, 'Docker\\API\\Model\\ContainerConfig', 'json', $context));
        }
        if (property_exists($data, 'Architecture') && $data->{'Architecture'} !== null) {
            $object->setArchitecture($data->{'Architecture'});
        }
        if (property_exists($data, 'Os') && $data->{'Os'} !== null) {
            $object->setOs($data->{'Os'});
        }
        if (property_exists($data, 'OsVersion') && $data->{'OsVersion'} !== null) {
            $object->setOsVersion($data->{'OsVersion'});
        }
        if (property_exists($data, 'Size') && $data->{'Size'} !== null) {
            $object->setSize($data->{'Size'});
        }
        if (property_exists($data, 'VirtualSize') && $data->{'VirtualSize'} !== null) {
            $object->setVirtualSize($data->{'VirtualSize'});
        }
        if (property_exists($data, 'GraphDriver') && $data->{'GraphDriver'} !== null) {
            $object->setGraphDriver($this->denormalizer->denormalize($data->{'GraphDriver'}, 'Docker\\API\\Model\\GraphDriverData', 'json', $context));
        }
        if (property_exists($data, 'RootFS') && $data->{'RootFS'} !== null) {
            $object->setRootFS($this->denormalizer->denormalize($data->{'RootFS'}, 'Docker\\API\\Model\\ImageRootFS', 'json', $context));
        }
        if (property_exists($data, 'Metadata') && $data->{'Metadata'} !== null) {
            $object->setMetadata($this->denormalizer->denormalize($data->{'Metadata'}, 'Docker\\API\\Model\\ImageMetadata', 'json', $context));
        }

        return $object;
    }

    public function normalize($object, $format = null, array $context = [])
    {
        $data = new \stdClass();
        if (null !== $object->getId()) {
            $data->{'Id'} = $object->getId();
        }
        if (null !== $object->getRepoTags()) {
            $values = [];
            foreach ($object->getRepoTags() as $value) {
                $values[] = $value;
            }
            $data->{'RepoTags'} = $values;
        }
        if (null !== $object->getRepoDigests()) {
            $values_1 = [];
            foreach ($object->getRepoDigests() as $value_1) {
                $values_1[] = $value_1;
            }
            $data->{'RepoDigests'} = $values_1;
        }
        if (null !== $object->getParent()) {
            $data->{'Parent'} = $object->getParent();
        }
        if (null !== $object->getComment()) {
            $data->{'Comment'} = $object->getComment();
        }
        if (null !== $object->getCreated()) {
            $data->{'Created'} = $object->getCreated();
        }
        if (null !== $object->getContainer()) {
            $data->{'Container'} = $object->getContainer();
        }
        if (null !== $object->getContainerConfig()) {
            $data->{'ContainerConfig'} = $this->normalizer->normalize($object->getContainerConfig(), 'json', $context);
        }
        if (null !== $object->getDockerVersion()) {
            $data->{'DockerVersion'} = $object->getDockerVersion();
        }
        if (null !== $object->getAuthor()) {
            $data->{'Author'} = $object->getAuthor();
        }
        if (null !== $object->getConfig()) {
            $data->{'Config'} = $this->normalizer->normalize($object->getConfig(), 'json', $context);
        }
        if (null !== $object->getArchitecture()) {
            $data->{'Architecture'} = $object->getArchitecture();
        }
        if (null !== $object->getOs()) {
            $data->{'Os'} = $object->getOs();
        }
        if (null !== $object->getOsVersion()) {
            $data->{'OsVersion'} = $object->getOsVersion();
        }
        if (null !== $object->getSize()) {
            $data->{'Size'} = $object->getSize();
        }
        if (null !== $object->getVirtualSize()) {
            $data->{'VirtualSize'} = $object->getVirtualSize();
        }
        if (null !== $object->getGraphDriver()) {
            $data->{'GraphDriver'} = $this->normalizer->normalize($object->getGraphDriver(), 'json', $context);
        }
        if (null !== $object->getRootFS()) {
            $data->{'RootFS'} = $this->normalizer->normalize($object->getRootFS(), 'json', $context);
        }
        if (null !== $object->getMetadata()) {
            $data->{'Metadata'} = $this->normalizer->normalize($object->getMetadata(), 'json', $context);
        }

        return $data;
    }
}
