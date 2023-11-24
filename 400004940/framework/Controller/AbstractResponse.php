<?php

namespace Controller;

/**
 * Abstract Response Class
 *
 * This abstract class provides a basic implementation of the ResponseInterface
 * for handling responses within the MVP framework's controller module.
 */
abstract class AbstractResponse implements InterfaceResponse
{

    /**
     * @var InterfaceAuthentication $authentication An authentication component implementing InterfaceAuthentication.
     */
    protected $authentication;
    /**
     * @var InterfaceErrorHandler $errorHandler An error handler component implementing InterfaceErrorHandler.
     */
    protected $errorHandler;
    /**
     * @var InterfaceSession $session A session component implementing InterfaceSession.
     */
    protected $session;
    /**
     * @var \Model\InterfaceORM $orm An Object-Relational Mapping (ORM) component implementing InterfaceORM.
     */
    protected $orm;
    /**
     * @var \Model\InterfaceUserModel $userModel A user model component implementing InterfaceUserModel.
     */
    protected $userModel;
    /**
     * @var \View\InterfaceFormGenerator $formGenerator A form generator component implementing InterfaceFormGenerator.
     */
    protected $validator;
    /**
     * @var \View\InterfaceFormGenerator $formGenerator A form generator component implementing InterfaceFormGenerator.
     */
    protected $formGenerator;
    /**
     * @var \View\InterfaceTemplateEngine $templateEngine A template engine component implementing InterfaceTemplateEngine.
     */
    protected $templateEngine;

    /**
     * Class Constructor
     *
     * Initializes the class with instances of various components used in the MVP framework.
     *
     * @param InterfaceAuthentication|null   $authentication   An optional authentication component implementing InterfaceAuthentication.
     * @param InterfaceErrorHandler|null      $errorHandler     An optional error handler component implementing InterfaceErrorHandler.
     * @param InterfaceSession|null           $session          An optional session component implementing InterfaceSession.
     * @param \Model\InterfaceORM|null        $orm              An optional Object-Relational Mapping (ORM) component implementing InterfaceORM.
     * @param \Model\InterfaceUserModel|null  $userModel        An optional user model component implementing InterfaceUserModel.
     * @param \View\InterfaceFormGenerator|null  $formGenerator  An optional form generator component implementing InterfaceFormGenerator.
     * @param \View\InterfaceTemplateEngine|null  $templateEngine  An optional template engine component implementing InterfaceTemplateEngine.
     */
    public function __construct(
        InterfaceAuthentication $authentication = null,
        InterfaceErrorHandler $errorHandler = null,
        InterfaceSession $session = null,
        \Model\InterfaceORM $orm = null,
        \Model\InterfaceUserModel $userModel = null,
        \View\InterfaceFormGenerator $formGenerator = null,
        \View\InterfaceTemplateEngine $templateEngine = null
    ) {
        $this->errorHandler = $errorHandler ?: new ErrorHandler(E_ALL);
        $this->orm = $orm ?: new \Model\ORM(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $this->userModel = $userModel ?: new \Model\UserModel();
        $this->formGenerator = $formGenerator ?: new \View\FormGenerator();
        $this->templateEngine = $templateEngine ?: new \View\TemplateEngine();
    }


    abstract public function auth();
    abstract public function execute($token ="");
}