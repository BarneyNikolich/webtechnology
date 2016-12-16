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
 * Handles static pages for themes
 *
 * @param object	$context	The context object for the site
 *
 * @return string	A template name
 */
        public function handle($context)
        {

            $formd = $context->formdata();
            $thmone = $formd->post('firstchoice');
            $thmtwo = $formd->post('secondchoice');
            $userhassubmitted = false;
            $themedeleted = false;

            if($context->hasuser()) //Only run when user is logged in or will cause error as getID returns null
            {
                $userid = $context->user()->getID();
                $existsid = R::find('themechoice', 'user_id = ?', [ $userid ]);
                if(sizeof($existsid) > 0) //if > 0 then at least 1 entry already exists for that user
                {
                    $userhassubmitted = true;
                }
            }
            if (($formd->post('firstchoice', '')) !== '')
            {
                $context->local()->addval('showerr', false);
                $context->local()->addval('alreadysubmitted', false);
                $context->local()->addval('alreadysubmitted', false);

                if($thmone === $thmtwo) //theme choice form values are equal
                {
                    $context->local()->addval('showerr', true);
                    $context->local()->addval('errormsg', 'Theme choices are equal! Choices must be different!');
//                    Web::getinstance()->bad();
                }
                elseif($themedeleted) //Themes have been deleted... allow user to reselect choices.
                {
                    $choice = R::dispense('themechoice');
                    $choice->user_id = $context->user()->getID();
                    $choice->theme1_id = $thmone;
                    $choice->theme2_id = $thmtwo;
                    R::store($choice);
                    $context->local()->addval('success', true);
                    $context->local()->addval('successmsg', 'Successful submission of choices.');
                }
                elseif($context->hasuser() and $userhassubmitted) //user has already submitted
                {
                    $context->local()->addval('alreadysubmitted', true);
                    $context->local()->addval('errorsubmit', 'You have already submitted.');
                }

                else
                {
                    $context->local()->addval('success', true);
                    $context->local()->addval('successmsg', 'Successful submission of choices.');

                    $choice = R::dispense('themechoice');
                    $choice->user_id = $context->user()->getID();
                    $choice->theme1_id = $thmone;
                    $choice->theme2_id = $thmtwo;
                    R::store($choice);
                }
            }
            return 'themes.twig';
        }
    }
?>
