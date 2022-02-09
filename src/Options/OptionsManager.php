<?php
namespace App\Options;

use App\Entity\SiteOption;
use App\Repository\SiteOptionRepository;
use Doctrine\ORM\EntityManagerInterface;

class OptionsManager {
    public function __construct(
        private SiteOptionRepository $repository,
        private EntityManagerInterface $em,
    ) {
    }
    public function getOption(string $name): string {
        $option = $this->repository->findOneBy(['optionName' => $name]);
        if (!$option) {
            return '';
        }
        return $option->getOptionValue();
    }
    public function setOption(string $name, string $value) {
        $option = $this->repository->findOneBy(['optionName' => $name]);
        if (!$option) {
            $option = new SiteOption();
            $option->setOptionName($name);
        }
        $option->setOptionValue($value);

        $this->em->persist($option);
        $this->em->flush();
    }
}
