<?php
/**
 * A class that contains code to return info needed in various places on the site
 *
 * @author Lindsay Marshall <lindsay.marshall@ncl.ac.uk>
 * @copyright 2014 Newcastle University
 *
 */
/**
 * Utility class that returns generally useful information about parts of the site
 */
    class SiteInfo
    {

/**
 * Get all the students beans
 *
 * @return array
 */
        public function students()
        {
            $studentID = R::findOne('rolename', 'name = ?', [ 'Student' ])->getID();
            $ids = R::getCol('select user_id from role where rolename_id=?', [$studentID]);

            $students = []; //create empty array
            foreach ($ids as $id) //for each element of p
            {
                $students[] = R::load('user', $id);
            }
            return $students;
        }

/**
 * Get all the themeleader beans
 *
 * @return array
 */
public function themeleaders()
        {

            $themeid = R::findOne('rolename', 'name =?', [ 'Themeleader' ])->getID();
            $ids = R::getCol('select user_id from role where rolename_id=?', [$themeid]);

            $themeleaders = []; //create empty array
            foreach ($ids as $id)
            {
                $themeleaders[] = R::load('user', $id);
            }
            return $themeleaders;
        }

/**
 * Get all the supervisor beans
 *
 * @return array
 */
        public function supervisors()
        {

            $supervisorid = R::findOne('rolename', 'name =?', [ 'Supervisor' ])->getID();
            $ids = R::getCol('select user_id from role where rolename_id=?', [$supervisorid]);

            $supervisors = []; //create empty array
            foreach ($ids as $id)
            {
                $supervisors[] = R::load('user', $id);
            }
            return $supervisors;
        }

/**
 * Get all the themeselection beans
 *
 * @return array
 */
        public function themeselection()
        {
            return R::findAll('themeselection', 'order by student_id');
        }

/**
 * Get all the students that have been assigned to a supervisor beans
 *
 * @return array
 */
        public function supervisorsutdent($id)
        {
            $ids = R::getCol('select student_id from allocatespvsr where supervisor_id=?', [$id]);
            return $ids;
        }

/**
 * Get all the themechoice beans
 *
 * @return array
 */
        public function choices()
        {
            return R::findAll('themechoice', 'order by user_id');
        }

/**
 * Get all the user beans
 *
 * @return array
 */
        public function users()
        {
            return R::findAll('user', 'order by login');
        }
/**
 * Get all the themes beans
 *
 * @return array
 */
        public function themes()
        {
            return R::findAll('theme', 'order by name');
        }

/**
 * Get all the topic beans
 *
 * @return array
 */
        public function topics()
        {
            return R::findAll('topic', 'order by name');
        }

/**
 * Get all the themes beans
 *
 * @return array
 */
        public function themebyid()
        {
            return R::findAll('topic', 'order by name');
        }


/**
 * Get all the page beans
 *
 * @return array
 */
        public function pages()
        {
            return R::findAll('page', 'order by name');
        }
/**
 * Get all the Rolename beans
 *
 * @return array
 */
        public function roles()
        {
            return R::findAll('rolename', 'order by name');
        }
/**
 * Get all the Rolecontext beans
 *
 * @return array
 */
        public function contexts()
        {
            return R::findAll('rolecontext', 'order by name');
        }
/**
 * Get all the site config information
 *
 * @return array
 */
        public function siteconfig()
        {
            return R::findAll('fwconfig');
        }
    }
?>
