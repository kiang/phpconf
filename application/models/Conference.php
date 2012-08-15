<?php

class Phpconf_Model_Conference extends Zend_Db_Table_Row_Abstract
{
    const SESSION_NORMAL = 'n';

    const SESSION_BREAK = 'b';

    const SESSION_OTHER = 'o';

    /**
     *
     * @param string $year
     * @return Phpconf_Model_Conference
     */
    public static function getInstanceFromYear($year)
    {
        $conferenceTable = new Phpconf_Model_DbTable_Conferences();
        $select = $conferenceTable->select()
                ->where('year = ?', $year);
        return $conferenceTable->fetchRow($select);
    }

    /**
     *
     * @return Zend_Db_Table_Rowset
     */
    public function fetchLatestAnnouncements()
    {
        $announcementTable = Phpconf_Model_DbTable_Announcements::getInstance();
        $select = $announcementTable->select()
                ->where('published = ?', 'y')
                ->order('id DESC');
        return $this->findDependentRowset('Phpconf_Model_DbTable_Announcements', 'Conference', $select);
    }

    /**
     *
     * @param int $id
     * @return Zend_Db_Table_Row
     */
    public function fetchAnnouncementById($id)
    {
        $announcementTable = Phpconf_Model_DbTable_Announcements::getInstance();
        return $announcementTable->find($id)->current();
    }

    /**
     *
     * @return Zend_Db_Table_Row
     */
    public function newAnnouncement()
    {
        $announcementTable = Phpconf_Model_DbTable_Announcements::getInstance();
        return $announcementTable->createRow(array(), Zend_Db_Table::DEFAULT_DB);
    }

    /**
     *
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function saveAnnouncement($id, $data)
    {
        $announcementTable = Phpconf_Model_DbTable_Announcements::getInstance();
        if (null === $id) {
            $announcement =
                $announcementTable->createRow($data, Zend_Db_Table::DEFAULT_DB);
        } else {
            $announcement = $this->fetchAnnouncementById($id);
            $announcement->setFromArray($data);
        }
        return $announcement->save();
    }

    /**
     *
     * @return Zend_Db_Table_Rowset
     */
    public function fetchSessions()
    {
        $sessionTable = Phpconf_Model_DbTable_Sessions::getInstance();
        $select = $sessionTable->select()
                ->setIntegrityCheck(false)
                ->from(array('s' => $sessionTable->info('name')))
                ->joinLeft(array('t' => 'talkers'), 's.talkerId = t.id', array(
                    'name',
                    'engName',
                    'nickname',
                    ))
                ->where('s.conferenceId=' . $this->id)
                ->order('s.startTime');
        return $sessionTable->fetchAll($select);
    }

    /**
     *
     * @param int $id
     * @return Zend_Db_Table_Row
     */
    public function fetchSessionById($id)
    {
        $sessionTable = Phpconf_Model_DbTable_Sessions::getInstance();
        return $sessionTable->find($id)->current();
    }

    /**
     *
     * @return Zend_Db_Table_Row
     */
    public function newSession()
    {
        $sessionTable = Phpconf_Model_DbTable_Sessions::getInstance();
        return $sessionTable->createRow(array(), Zend_Db_Table::DEFAULT_DB);
    }

    /**
     *
     * @return Zend_Db_Table_Rowset
     */
    public function fetchStaffs()
    {
        $staffTable = Phpconf_Model_DbTable_Staffs::getInstance();
        $select = $staffTable->select()
                ->order('name');
        return $this->findDependentRowset('Phpconf_Model_DbTable_Staffs', 'Conference', $select);
    }

    /**
     *
     * @param int $id
     * @return Zend_Db_Table_Row
     */
    public function fetchStaffById($id)
    {
        $staffTable = Phpconf_Model_DbTable_Staffs::getInstance();
        return $staffTable->find($id)->current();
    }

    /**
     *
     * @return Zend_Db_Table_Row
     */
    public function newStaff()
    {
        $staffTable = Phpconf_Model_DbTable_Staffs::getInstance();
        return $staffTable->createRow(array(), Zend_Db_Table::DEFAULT_DB);
    }

    /**
     *
     * @return Zend_Db_Table_Rowset
     */
    public function fetchJobs()
    {
        $jobTable = Phpconf_Model_DbTable_Jobs::getInstance();
        $select = $jobTable->select()
                ->where('display = ?', 'y')
                ->order('sortOrder');
        return $jobTable->fetchAll($select);
    }

    /**
     *
     * @param int $id
     * @return Zend_Db_Table_Row
     */
    public function fetchJobById($id)
    {
        $jobTable = Phpconf_Model_DbTable_Jobs::getInstance();
        return $jobTable->find($id)->current();
    }

    /**
     *
     * @return Zend_Db_Table_Row
     */
    public function newJob()
    {
        $jobTable = Phpconf_Model_DbTable_Jobs::getInstance();
        return $jobTable->createRow(array(), Zend_Db_Table::DEFAULT_DB);
    }

    /**
     *
     * @return Zend_Db_Table_Rowset
     */
    public function fetchSponsors()
    {
        $sponsorTable = Phpconf_Model_DbTable_Sponsors::getInstance();
        $select = $sponsorTable->select()
                ->order('sortOrder');
        return $this->findDependentRowset('Phpconf_Model_DbTable_Sponsors', 'Conference', $select);
    }

    /**
     *
     * @param int $id
     * @return Zend_Db_Table_Row
     */
    public function fetchSponsorById($id)
    {
        $sponsorTable = Phpconf_Model_DbTable_Sponsors::getInstance();
        return $sponsorTable->find($id)->current();
    }

    /**
     *
     * @return Zend_Db_Table_Row
     */
    public function newSponsor()
    {
        $sponsorTable = Phpconf_Model_DbTable_Sponsors::getInstance();
        return $sponsorTable->createRow(array(), Zend_Db_Table::DEFAULT_DB);
    }

    /**
     *
     * @return Zend_Db_Table_Rowset
     */
    public function fetchTalkers()
    {
        $talkerTable = Phpconf_Model_DbTable_Talkers::getInstance();
        $select = $talkerTable->select()
                ->order('name');
        return $this->findDependentRowset('Phpconf_Model_DbTable_Talkers', 'Conference', $select);
    }

    /**
     *
     * @param int $id
     * @return Zend_Db_Table_Row
     */
    public function fetchTalkerById($id)
    {
        $talkerTable = Phpconf_Model_DbTable_Talkers::getInstance();
        return $talkerTable->find($id)->current();
    }

    /**
     *
     * @return Zend_Db_Table_Row
     */
    public function newTalker()
    {
        $talkerTable = Phpconf_Model_DbTable_Talkers::getInstance();
        return $talkerTable->createRow(array(), Zend_Db_Table::DEFAULT_DB);
    }

    /**
     *
     * @return Zend_Db_Table_Rowset
     */
    public static function fetchConferences()
    {
        $conferenceTable = Phpconf_Model_DbTable_Conferences::getInstance();
        $select = $conferenceTable->select()
                ->order('year DESC');
        return $conferenceTable->fetchAll($select);
    }

    /**
     *
     * @param int $id
     * @return Zend_Db_Table_Row
     */
    public static function fetchConferenceById($id)
    {
        $conferenceTable = Phpconf_Model_DbTable_Conferences::getInstance();
        return $conferenceTable->find($id)->current();
    }

    /**
     *
     * @return Zend_Db_Table_Row
     */
    public static function newConference()
    {
        $conferenceTable = Phpconf_Model_DbTable_Conferences::getInstance();
        return $conferenceTable->createRow(array(), Zend_Db_Table::DEFAULT_DB);
    }

    /**
     *
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public static function saveConference($id, $data)
    {
        $conferenceTable = Phpconf_Model_DbTable_Conferences::getInstance();
        if (empty($id)) {
            $conference =
                $conferenceTable->createRow($data, Zend_Db_Table::DEFAULT_DB);
        } else {
            $conference = $conferenceTable->find($id)->current();
            $conference->setFromArray($data);
        }
        return $conference->save();
    }

    public function registrable()
    {
        $today = date('Y-m-d H:i:s');
        return ($this->registrationStartDate <= $today && $today <= $this->registrationEndDate);
    }
}

