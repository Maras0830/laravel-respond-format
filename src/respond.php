<?php

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

CONST SUCCESS_STATUS = 'success';
CONST NOT_FOUND_STATUS = 'not_found';
CONST TOKEN_REQUIRED = 'token_required';
CONST MEMBER_NOT_FOUND = 'member_not_found';
CONST INPUT_IS_REQUIRED = 'input_required';
CONST INVALID_FORM_DATA = 'invalid_form_data';

CONST SUCCESS_CODE = 200;
CONST NOT_FOUND_CODE = 404;
CONST TOKEN_REQUIRED_CODE = 203;
CONST MEMBER_NOT_FOUND_CODE = 404;
CONST INPUT_IS_REQUIRED_CODE = 422;
CONST INVALID_FORM_DATA_CODE = 422;

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
        $response['error'] = [
            'message' => $message,
            'type' => $type,
            'code' => $code
        ];

        if (!empty($data) and $code == 200) {
            if ($code == 200)
                $response['data'] = $data;
            else
                $response['error']['data'] = $data;
        }
        
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

        return respond('Success.', SUCCESS_CODE, $data, SUCCESS_STATUS, $paginator);
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
        return respond('Success.', SUCCESS_CODE, $data, SUCCESS_STATUS);
    }
}


if (! function_exists('register_group_success')) {
    /**
     * @param array $tickets
     * @return JsonResponse
     */
    function register_group_success(array $tickets): JsonResponse
    {
        return respond('Success.', SUCCESS_CODE, $tickets, SUCCESS_STATUS);
    }
}

if (! function_exists('not_found')) {
    /**
     * @return JsonResponse
     */
    function not_found(): JsonResponse
    {
        return respond('Data not found.', NOT_FOUND_CODE, [], NOT_FOUND_STATUS);
    }
}

if (! function_exists('input_is_required')) {
    /**
     * @param $data
     * @return JsonResponse
     */
    function input_is_required($data): JsonResponse
    {
        return respond('Input required.', INPUT_IS_REQUIRED_CODE, $data, INPUT_IS_REQUIRED);
    }
}


if (! function_exists('token_required')) {
    /**
     * @return JsonResponse
     */
    function token_required(): JsonResponse
    {
        return respond('Token required.', TOKEN_REQUIRED_CODE, [], TOKEN_REQUIRED);
    }
}


if (! function_exists('member_not_found')) {
    /**
     * @return JsonResponse
     */
    function member_not_found(): JsonResponse
    {
        return respond('Member not found.', MEMBER_NOT_FOUND_CODE, [], MEMBER_NOT_FOUND);
    }
}

if (! function_exists('form_data_invalid')) {
    /**
     * @return JsonResponse
     */
    function form_data_invalid($data): JsonResponse
    {
        return respond('invalid form data.', INVALID_FORM_DATA_CODE, $data, INVALID_FORM_DATA);
    }
}


