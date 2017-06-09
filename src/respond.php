<?php

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

CONST SUCCESS_STATUS = 'success';
CONST NOT_FOUND_STATUS = 'not_found';
CONST TOKEN_REQUIRED = 'token_required';
CONST MEMBER_NOT_FOUND = 'member_not_found';
CONST INPUT_IS_REQUIRED = 'input_required';
CONST INVALID_FORM_DATA = 'invalid_form_data';

CONST SUCCESS_CODE = Response::HTTP_OK; // 200
CONST NOT_FOUND_CODE = Response::HTTP_NOT_FOUND; // 404
CONST TOKEN_REQUIRED_CODE = Response::HTTP_NON_AUTHORITATIVE_INFORMATION; // 203
CONST MEMBER_NOT_FOUND_CODE = Response::HTTP_NOT_FOUND; // 404
CONST INPUT_IS_REQUIRED_CODE = Response::HTTP_UNPROCESSABLE_ENTITY; // 422
CONST INVALID_FORM_DATA_CODE = Response::HTTP_UNPROCESSABLE_ENTITY; // 422

if (! function_exists('respond')) {
    function respond($data, array $error = [], ...$meta)
    {
        if (!empty($error))
            $response['error'] = $error;

        if (!empty($data))
            $response['data'] = $data;

        if (!empty($meta))
            $response['meta'] = $meta;

        return response()->json($response, 200);
    }
}

if (! function_exists('not_found')) {
    /**
     * @return JsonResponse
     */
    function not_found(): JsonResponse
    {
        return respond([], error_format('Data not found.', NOT_FOUND_CODE, NOT_FOUND_STATUS));
    }
}

if (! function_exists('error_format')) {
    function error_format(string $message, int $code, string $type, $data = [])
    {
        $error_response = [
            "message" => $message,
            "code" => $code,
            "type" => $type
        ];

        if (!empty($data))
            $error_response['data'] = $data;

        return $error_response;
    }
}

if (! function_exists('input_is_required')) {
    /**
     * @param $data
     * @return JsonResponse
     */
    function input_is_required($data): JsonResponse
    {
        return respond([], error_format('Input required.', INPUT_IS_REQUIRED_CODE, INPUT_IS_REQUIRED));
    }
}


if (! function_exists('token_required')) {
    /**
     * @return JsonResponse
     */
    function token_required(): JsonResponse
    {
        return respond([], error_format('Token required.', TOKEN_REQUIRED_CODE, TOKEN_REQUIRED));
    }
}


if (! function_exists('member_not_found')) {
    /**
     * @return JsonResponse
     */
    function member_not_found(): JsonResponse
    {
        return respond([], error_format('Member not found.', MEMBER_NOT_FOUND_CODE, MEMBER_NOT_FOUND));
    }
}

if (! function_exists('form_data_invalid')) {
    /**
     * @return JsonResponse
     */
    function form_data_invalid($data): JsonResponse
    {
        return respond([], error_format('Form data Invalid.', INVALID_FORM_DATA_CODE, INVALID_FORM_DATA));
    }
}

