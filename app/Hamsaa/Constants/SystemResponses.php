<?php

namespace App\Hamsaa\Constants;

abstract class SystemResponses
{
    // Authentication
    // 401
    const WRONG_CREDENTIALS = 'WRONG_CREDENTIALS';

    const TOKEN_NOT_PROVIDED = 'TOKEN_NOT_PROVIDED';
    const TOKEN_EXPIRED = 'TOKEN_EXPIRED';
    const TOKEN_INVALID = 'TOKEN_INVALID';

    // Not Found
    // 404
    const RESOURCE_NOT_FOUND = 'RESOURCE_NOT_FOUND';

    //403
    const USER_NOT_AUTHORIZED = 'USER_NOT_AUTHORIZED';

    //409
    const PARAMETERS_HAVE_CONFLICT = 'PARAMETERS_HAVE_CONFLICT';
}
