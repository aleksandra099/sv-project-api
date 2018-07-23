<?php

namespace AppBundle\Command;

use AppBundle\Entity\Article;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class PopulateArticleDataCommand extends ContainerAwareCommand
{
    /** @var InputInterface */
    private $input;

    /** @var OutputInterface */
    private $output;

    /** @var EntityManager */
    private $entityManager;

    protected function configure()
    {
        $this->setName('articles:populate-data')
            ->setDescription('Insert json data')
            ->addArgument('in', InputArgument::REQUIRED, 'data list json');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->input  = $input;
        $this->output = $output;

        $in = $input->getArgument('in');

        $rawData = file_get_contents($in);

        $data = json_decode($rawData, true);

        $this->entityManager = $this->getContainer()->get('doctrine.orm.entity_manager');
        $br=0;
        foreach ($data as $datum) {
//            $this->output->writeln($datum['name']);
            $article = new Article();
            $article->setName($datum['name']);
            $article->setCode($datum['code']+$br);
            $article->setImageUrl($datum['imageUrl']);
            $article->setPrice($datum['price']);
            $article->setDiscount($datum['discount']);
            $article->setGender($datum['gender']);
            $article->setType($datum['type']);
            $article->setSizes($datum['sizes']);
            $article->setUpdatedAt(new \DateTime());
            $this->entityManager->persist($article);
            $br++;
        }
        $this->entityManager->flush();
    }

}