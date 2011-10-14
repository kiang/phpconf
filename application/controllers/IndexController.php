<?php

class IndexController extends Zend_Controller_Action
{

    /**
     *
     * @var Phpconf_Model_Conference
     */
    protected $_conference = null;

    public function init()
    {
        $this->_helper->contextSwitch()
                      ->addActionContext('oembed', 'json')
                      ->addActionContext('oembed', 'xml')
                      ->initContext();
    }

    public function preDispatch()
    {
        $this->_conference = $this->getHelper('Conference')->getConference();
        $this->view->conference = $this->_conference;
        $this->view->actionName = $this->getRequest()->getActionName();
    }

    public function indexAction()
    {
        $this->view->announcements = $this->_conference->fetchLatestAnnouncements();
    }

    public function locationAction()
    {

    }

    public function sessionsAction()
    {
        $this->view->sessions = $this->_conference->fetchSessions();
    }

    public function talkersAction()
    {
        $this->view->talkers = $this->_conference->fetchTalkers();
    }

    public function staffsAction()
    {
        $this->view->jobs = $this->_conference->fetchJobs();
        $this->view->staffs = $this->_conference->fetchStaffs();
    }

    public function mobileAction()
    {
        $this->getHelper('layout')->disableLayout();
        $this->view->announcements = $this->_conference->fetchLatestAnnouncements();
        $this->view->sessions = $this->_conference->fetchSessions();
    }

    public function oembedAction()
    {
        $this->getHelper('layout')->disableLayout();
        $this->view->clearVars();
        $this->view->assign(array(
            'version' => '1.0',
            'type' => 'rich',
            'title' => 'PHPConf Taiwan ' . $this->_conference->year,
            'thumbnail' => 'http://phpconf.tw/img/logo/phpconf.jpg',
            'providerName' => 'PHPConf Taiwan',
            'providerUrl' => 'http://phpconf.tw/',
        ));
    }

}

