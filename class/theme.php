<?php
/**
 * A class that contains code to implement Multi nested static pages
 *
 * @author Lindsay Marshall <lindsay.marshall@ncl.ac.uk>
 * @copyright 2012-2013 Newcastle University
 *
 */
/**
 * Provide support for topics
 */
    class Theme extends Siteaction
    {
/**
 * Handles static pages that are nested in depth /multi/level/page
 *
 * @param object	$context	The context object for the site
 *
 * @return string	A template name
 */
        public function handle($context)
        {
            $formd = $context->formdata(); //Gets parameters out of page! Use as search bar!
            $tone = $formd->post('firstchoice');
            $ttwo = $formd->post('secondchoice');
            $userhassubmitted = false;

            if($context->hasuser()) //Only run when user is logged in or will cause error as getID returns null
            {
                $userid = $context->user()->getID();
                $existsid = R::find('themechoice', 'user_id = ?', [ $userid ]);
                if(sizeof($existsid) > 0)
                {
                    $userhassubmitted = true;
                }

            }
            if (($formd->post('firstchoice', '')) !== '')
            {
                $context->local()->addval('showerr', false);
                $context->local()->addval('alreadysubmitted', false);

                if($tone === $ttwo)
                {
                    $context->local()->addval('showerr', true); // add to local
                    $context->local()->addval('errormsg', 'Theme choices are equal! Choices must be different!');
//                    Web::getinstance()->bad();
                }
                elseif($context->hasuser() and $userhassubmitted)
                {
                    $context->local()->addval('alreadysubmitted', true);
                    $context->local()->addval('errorsubmit', 'You have already submitted.');
                }
                else
                {
                    $choice = R::dispense('themechoice');
                    $choice->user_id = $context->user()->getID();
                    $choice->theme1_id = $tone;
                    $choice->theme2_id = $ttwo;
                    R::store($choice);
                }



            }
//
//            $rest = $context->rest();
//            if(sizeof($rest) > 1) //Only execute if called from themes.twig
//            {
//                $themeid = $rest[1];
//                $context->local()->addval('fltrtheme', $themeid); // add to local
//            }
//
//            if (($searchval = $formd->post('topicname', '')) !== '')
//            {
//                foreach($formd->mustposta('selectthemes') as $id => $themeid) //For each theme seclected create the relevant table entrys
//                {
//                    $topic = R::dispense('topic');
//                    $topic->name = $searchval;
//                    $topic->description = $formd->post('description');
//                    $topic->theme = $context->load('theme', $themeid);
//                    R::store($topic);
//                }
//            }





            return 'themes.twig';
        }
    }
?>
