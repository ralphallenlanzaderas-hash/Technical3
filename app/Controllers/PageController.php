<?php

namespace App\Controllers;

class PageController extends BaseController
{
    /**
     * About Page (/about) - Static page introducing the developer.
     */
    public function about()
    {
        $data = [
            'pageTitle'     => 'About the Developer',
            'developerName' => 'Senior PHP Developer',
            'role'          => 'Web Systems Specialist',
            'bio'           => 'Specializing in robust PHP frameworks, enterprise software architecture, clean code standards, and CodeIgniter 4 application development.',
        ];

        return view('about', $data);
    }
}