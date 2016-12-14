<?php
/**
 * A class that contains code to implement a Profile page
 *
 * @author Lindsay Marshall <lindsay.marshall@ncl.ac.uk>
 * @copyright 2012-2015 Newcastle University
 *
 */
/**
 * Support the /contact page
 */
    class Profile extends Siteaction
    {
/**
 * Handle contact operations /contact/xxxx
 *
 * @param object	$context	The context object for the site
 *
 * @return string	A template name
 */
        public function handle($context)
        {
            $formd = $context->formdata();
		        if (($email = $formd->post('email', '')) !== '')
            { # there is a post
              // $user = context->user();
            //   $user->email = $email;
            //   R::Store($user);
            //   $context->local()->addval('done', TRUE);
            }
            return 'profile.twig';
        }
    }
?>
