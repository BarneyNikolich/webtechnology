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
    class Topic extends Siteaction
    {
/**
 * Handles static pages for topics/xxxx
 *
 * @param object	$context	The context object for the site
 *
 * @return string	A template name
 */
        public function handle($context)
        {
            $formd = $context->formdata(); //Gets parameters out of page! Use as search bar!

            $rest = $context->rest();
            if(sizeof($rest) > 1) //Only execute if called from themes.twig as URI will have topic ID appended
            {
                $themeid = $rest[1]; //get themeID
                $context->local()->addval('fltrtheme', $themeid); // add to local
            }

            if (($searchval = $formd->post('topicname', '')) !== '')
            {


                foreach($formd->mustposta('selectthemes') as $id => $themeid) //For each theme seclected create the relevant table entrys
                {
                    $topic = R::dispense('topic');
                    $topic->name = $searchval;
                    $topic->description = $formd->post('description');
                    $topic->theme = $context->load('theme', $themeid);
                    $hidden = $formd->post('hidden');
                    $context->local()->addval('test', $hidden); // add to local

                    if($hidden == 'on')
                    {
                        $topic->checked = true;
                    }
                    else
                    {
                        $topic->checked = false;
                    }

                    R::store($topic);
                }
            }
            return 'topics.twig';
        }
    }
?>
