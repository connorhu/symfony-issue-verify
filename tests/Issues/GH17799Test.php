<?php

/**
 * url: https://github.com/symfony/symfony/issues/17799
 * title: Update for ChoiceType field via PATCH HTTP method doesn't work
 */

namespace App\Tests\Issues;

use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Test\FormIntegrationTestCase;

class GH17799Test extends FormIntegrationTestCase
{
    public function test()
    {
        $submitted = ['items' => [2, 4]];
        $existing  = ['items' => [1, 3]];
        $builder = $this->factory->createBuilder(FormType::class, $existing, []);
        
        $builder->add('items', ChoiceType::class, [
            'choices'  => [
                   'One'   => 1,
                   'Two'   => 2,
                   'Three' => 3,
                   'Four'  => 4,
                   'Five'  => 5,
               ],
               'expanded' => true,
               'multiple' => true,
           ],
        );
        
        $form = $builder->getForm();
        $form->submit($submitted, false);
        
        $this->assertSame([
            2, 4
        ], $form->getData()['items']);
    }
}
