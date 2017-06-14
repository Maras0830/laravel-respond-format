<?php

use Illuminate\Http\Response;

CONST SUCCESS_STATUS = 'success';
CONST NOT_FOUND_STATUS = 'not_found';
CONST TOKEN_REQUIRED = 'token_required';
CONST MEMBER_NOT_FOUND = 'member_not_found';
CONST INPUT_IS_REQUIRED = 'input_required';
CONST INVALID_FORM_DATA = 'invalid_form_data';

CONST SUCCESS_CODE = Illuminate\Http\Response::HTTP_OK; // 200
CONST NOT_FOUND_CODE = Illuminate\Http\Response::HTTP_NOT_FOUND; // 404
CONST TOKEN_REQUIRED_CODE = Illuminate\Http\Response::HTTP_NON_AUTHORITATIVE_INFORMATION; // 203
CONST MEMBER_NOT_FOUND_CODE = Illuminate\Http\Response::HTTP_NOT_FOUND; // 404
CONST INPUT_IS_REQUIRED_CODE = Illuminate\Http\Response::HTTP_UNPROCESSABLE_ENTITY; // 422
CONST INVALID_FORM_DATA_CODE = Illuminate\Http\Response::HTTP_UNPROCESSABLE_ENTITY; // 422

if (! function_exists('respond')) {
    function respond($data, array $error = [], ...$meta)
    {
        $response = [];

        if (!empty($error))
            $response['error'] = $error;

        if (!empty($data))
            $response['data'] = $data;

        if (!empty($meta))
            $response['meta'] = array_collapse($meta);

        return new Illuminate\Http\JsonResponse($response,200);
    }
}

if (! function_exists('not_found')) {
    /**
     * @return Illuminate\Http\JsonResponse
     */
    function not_found(): Illuminate\Http\JsonResponse
    {
        return respond([], error_format('Data not found.', NOT_FOUND_CODE, NOT_FOUND_STATUS));
    }
}

if (! function_exists('error_format')) {
    function error_format(string $message, int $code, string $type, ...$data)
    {
        $error_response = [
            "message" => $message,
            "code" => $code,
            "type" => $type
        ];

        $error_response = !empty($data) ? array_merge($error_response, array_collapse($data)) : $error_response;

        return $error_response;
    }
}

if (! function_exists('input_is_required')) {
    /**
     * @param $data
     * @return Illuminate\Http\JsonResponse
     */
    function input_is_required($data = []): Illuminate\Http\JsonResponse
    {
        return respond([], error_format('Input required.', INPUT_IS_REQUIRED_CODE, INPUT_IS_REQUIRED, $data));
    }
}


if (! function_exists('token_required')) {
    /**
     * @return Illuminate\Http\JsonResponse
     */
    function token_required(): Illuminate\Http\JsonResponse
    {
        return respond([], error_format('Token required.', TOKEN_REQUIRED_CODE, TOKEN_REQUIRED));
    }
}


if (! function_exists('member_not_found')) {
    /**
     * @return Illuminate\Http\JsonResponse
     */
    function member_not_found(): Illuminate\Http\JsonResponse
    {
        return respond([], error_format('Member not found.', MEMBER_NOT_FOUND_CODE, MEMBER_NOT_FOUND));
    }
}

if (! function_exists('form_data_invalid')) {
    /**
     * @param array $data
     * @return Illuminate\Http\JsonResponse
     */
    function form_data_invalid($data = []): Illuminate\Http\JsonResponse
    {
        return respond([], error_format('Form data Invalid.', INVALID_FORM_DATA_CODE, INVALID_FORM_DATA, $data));
    }
}

