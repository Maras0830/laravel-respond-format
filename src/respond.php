<?php

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

CONST SUCCESS_STATUS = 'Success.';
CONST NOT_FOUND_STATUS = 'Not Found.';
CONST TOKEN_NOT_FOUND = 'Token Not Found.';
CONST MEMBER_NOT_FOUND = 'Member Not Found.';
CONST INPUT_IS_REQUIRED = ' is required';

CONST SUCCESS_CODE = Response::HTTP_OK;
CONST NOT_FOUND_CODE = Response::HTTP_NOT_FOUND;
CONST TOKEN_NOT_FOUND_CODE = Response::HTTP_NON_AUTHORITATIVE_INFORMATION;
CONST MEMBER_NOT_FOUND_CODE = Response::HTTP_NOT_FOUND;
CONST INPUT_IS_REQUIRED_CODE = Response::HTTP_UNPROCESSABLE_ENTITY;

if (! function_exists('respond')) {
    /**
     * @param string $message
     * @param int $code
     * @param array $data
     * @param string $type
     * @param array $paginator
     * @return JsonResponse
     */
    function respond(string $message, int $code = 200, $data = [], string $type = '', array $paginator = []): JsonResponse
    {
        $response['status'] = $message;
        $response['code'] = $code;

        if (!empty($data))
            $response['data'] = $data;
        if (!empty($type))
            $response['type'] = $type;
        if (!empty($paginator))
            $response['paginator'] = $paginator;

        return response()->json($response, 200);
    }
}

if (! function_exists('lists')) {
    /**
     * 回傳 list array.
     *
     * @param string $list_name
     * @param $data
     * @param int $current_page
     * @param int $per_page
     * @return JsonResponse
     */
    function lists(string $list_name, $data, int $current_page = 1, int $per_page = 10): JsonResponse
    {
        $paginator = [
            'total' => count($data),
            'per_page' => $per_page,
            'current_page' => $current_page,
            "last_page" => (count($data) > $per_page) ? (int)count($data) / $per_page : 1,
            "prev_page_url" => ($current_page != 1) ? $current_page - 1 : 1,
            "next_page_url" => ($current_page != 1 and $current_page != count($data) / $per_page) ? $current_page + 1 : 1,
            "from" => $per_page + 1 * $current_page,
            "to" => $per_page * $current_page
        ];

        return respond(SUCCESS_STATUS, SUCCESS_CODE, $data, $list_name, $paginator);
    }
}

if (! function_exists('single')) {
    /**
     * 回傳 單筆
     *
     * @param $data
     * @return JsonResponse
     */
    function single($data): JsonResponse
    {
        return respond(SUCCESS_STATUS, SUCCESS_CODE, $data);
    }
}


if (! function_exists('register_group_success')) {
    /**
     * @param array $tickets
     * @return JsonResponse
     */
    function register_group_success(array $tickets): JsonResponse
    {
        return respond(SUCCESS_STATUS, SUCCESS_CODE, $tickets);
    }
}

if (! function_exists('not_found')) {
    /**
     * @return JsonResponse
     */
    function not_found(): JsonResponse
    {
        return respond(NOT_FOUND_STATUS, NOT_FOUND_CODE, [], 'data_not_found');
    }
}

if (! function_exists('input_is_required')) {
    /**
     * @param $data
     * @return JsonResponse
     */
    function input_is_required($data): JsonResponse
    {
        return respond(INPUT_IS_REQUIRED, INPUT_IS_REQUIRED_CODE, $data);
    }
}


if (! function_exists('token_not_found')) {
    /**
     * @return JsonResponse
     */
    function token_not_found(): JsonResponse
    {
        return respond(TOKEN_NOT_FOUND, TOKEN_NOT_FOUND_CODE, [], 'token_required');
    }
}


if (! function_exists('member_not_found')) {
    /**
     * @return JsonResponse
     */
    function member_not_found(): JsonResponse
    {
        return respond(MEMBER_NOT_FOUND, MEMBER_NOT_FOUND_CODE, [], 'member_not_fund');
    }
}


