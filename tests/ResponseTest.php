<?php

namespace maras0830\laravelRespondFormat\Tests;

use Illuminate\Console\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\App;

/**
 * Class ResponseTest
 */
class ResponseTest extends \PHPUnit_Framework_TestCase
{
    public function test_respond()
    {
        $data = [
            'name' => 'Maras',
            'nickname' => 'maras chen'
        ];

        $except = [
            'data' => $data
        ];

        $actual = respond($data, []);

        $this->assertTrue($actual instanceof JsonResponse);

        $this->assertSame($except, json_decode($actual->content(), true));
    }

    public function test_respond_with_meta()
    {
        $data = [
            'name' => 'Maras',
            'nickname' => 'maras chen'
        ];

        $meta = ['_paginator' => ['current_url' => 'https://example.com?page=1']];

        $except = ['data' => $data, 'meta' => $meta];

        $actual = respond($data, [], $meta);

        $this->assertTrue($actual instanceof JsonResponse);

        $this->assertSame($except, json_decode($actual->content(), true));
    }

    public function test_not_found()
    {
        $error = [
            'message' => 'Data not found.',
            'code' => 404,
            'type' => 'not_found'
        ];

        $except = [
            'error' => $error
        ];

        $actual = not_found();

        $this->assertTrue($actual instanceof JsonResponse);

        $this->assertSame($except, json_decode($actual->content(), true));
    }

    public function test_input_is_required()
    {
        $required_data = [
            'required' => [
                'name', 'nickname'
            ]
        ];

        $error = [
            'message' => 'Input required.',
            'code' => 422,
            'type' => 'input_required'
        ];

        $except = [
            'error' => array_merge($error, $required_data)
        ];

        $actual = input_is_required($required_data);

        $this->assertTrue($actual instanceof JsonResponse);

        $this->assertSame($except, json_decode($actual->content(), true));
    }

    public function test_token_required()
    {
        $error = [
            'message' => 'Token required.',
            'code' => 203,
            'type' => 'token_required'
        ];

        $except = [
            'error' => $error
        ];

        $actual = token_required();

        $this->assertTrue($actual instanceof JsonResponse);

        $this->assertSame($except, json_decode($actual->content(), true));
    }

    public function test_member_not_found()
    {
        $error = [
            'message' => 'Member not found.',
            'code' => 404,
            'type' => 'member_not_found'
        ];

        $except = [
            'error' => $error
        ];

        $actual = member_not_found();

        $this->assertTrue($actual instanceof JsonResponse);

        $this->assertSame($except, json_decode($actual->content(), true));
    }

    public function test_form_data_invalid()
    {
        $invalid_form_fields = [
            'fields' => [
                'name', 'nickname'
            ]
        ];

        $error = [
            'message' => 'Form data Invalid.',
            'code' => 422,
            'type' => 'invalid_form_data'
        ];

        $except = [
            'error' => array_merge($error, $invalid_form_fields)
        ];

        $actual = form_data_invalid($invalid_form_fields);

        $this->assertTrue($actual instanceof JsonResponse);

        $this->assertSame($except, json_decode($actual->content(), true));
    }
}