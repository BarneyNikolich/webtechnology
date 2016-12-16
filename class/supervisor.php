<?php
/**
 * A class that contains code to implement Multi nested static pages
 *
 * @author Lindsay Marshall <lindsay.marshall@ncl.ac.uk>
 * @copyright 2012-2013 Newcastle University
 *
 */
/**
 * Provide support for supervisors
 */
    class Supervisor extends Siteaction
    {
/**
 *
 * @param object	$context	The context object for the site
 *
 * @return string	A template name
 */
        public function handle($context)
        {
            $context->mebesupervisor();

            $formd = $context->formdata(); //Gets parameters out of page! Use as search bar!
            if($formd->haspost('submitbutton'))
            {
                $supervisor = $formd->post('spvsrselect');
                $student_id = $formd->post('submitbutton');
                $userhasallocated = false;

                $existsid = R::find('allocatespvsr', 'supervisor_id = ?', [ $student_id ]);
                if(sizeof($existsid) > 0) //if > 0 then at least 1 entry already exists for that user
                {
                    $userhasallocated = true;
                }
                if($userhasallocated)
                {
                    $context->local()->addval('alreadysubmitted', true);
                    $context->local()->addval('errorsubmit', 'You have already submitted for that user');
                }
                else
                {
                    $context->local()->addval('success', true);
                    $context->local()->addval('successmsg', 'Successful submission of choices.');
                    $spvsr = R::dispense('allocatespvsr');
                    $spvsr->student_id = $supervisor;
                    $spvsr->supervisor_id = $student_id;
                    R::store($spvsr);
                }
            }
            return 'supervisor.twig';


        }
    }
?>
