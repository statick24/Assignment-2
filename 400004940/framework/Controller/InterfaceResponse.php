<?php

namespace Controller;
/**
 * Response Interface
 *
 * This interface defines methods for handling responses within the MVP framework's controller module.
 */
interface InterfaceResponse
{
    /**
     * Authorization
     *
     * Controls the authorization of the page. Implement this method to handle
     * authorization logic before rendering the page.
     *
     */
    public function auth();
    /**
     * Execute
     *
     * Creates the page content. Implement this method to generate and output
     * the HTML, JSON, or other content that will be sent as the response.
     */
    public function execute($token = "");
}
