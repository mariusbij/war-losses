<?php

namespace Tests\Feature;

use Tests\TestCase;

class PagesTest extends TestCase
{
    public function testTheHomePageReturnsSuccess(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function testTheStatsPageReturnsSuccess(): void
    {
        $response = $this->get('/stats');
        $response->assertStatus(200);
    }

    public function testTheReportNewPageReturnsSuccess(): void
    {
        $response = $this->get('/report-new');
        $response->assertStatus(200);
    }
}
