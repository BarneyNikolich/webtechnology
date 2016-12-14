<?php
/**
 * A class that contains code to implement a documents page
 *
 * @author Tom Ford <t.ford@ncl.ac.uk>
 * @copyright 2015 Newcastle University
 *
 */

    class Redbeantest extends Siteaction
    {
      /**
       * Handle documents operations /documents/xxxx
       *
       * @param object $context The context object for the site
       *
       * @return string    A template name
       */
        public function handle($context)
        {
//            mail('barney.nikolich@gmail.com', 'Test', 'Test');

            $formd = $context->formdata(); //Gets parameters out of page! Use as search bar!
            if (($msg = $formd->post('message', '')) !== '')
            {
                    $context->local()->addval('done', TRUE);
                    $rbtest = R::dispense('rbtest'); //Create new bean called documents
                    $rbtest->description = $context->mustpost('description');


//
                $id = R::store($rbtest);
//                $context->local()->addval('done', TRUE);
//
                if (($msg = $context->post('message', '')) !== '')
                { # there is a post
////                    mail(Config::SYSADMIN, $context->postpar('subject', 'No Subject'), $msg);
//                    mail('barney.nikolich@gmail.com', 'Test', 'Test');
                    $context->local()->addval('done', TRUE);
                }
//
            }


                return 'redbeantest.twig';
        }
    }
?>
