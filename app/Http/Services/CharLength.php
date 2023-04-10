<?php

namespace App\Http\Services;

class CharLength
{
    /** User Fields Start */
    public const MIN_PASSWORD = 8;
    public const MAX_PASSWORD = 50;

    public const MIN_EMAIL = 8;
    public const MAX_EMAIL = 50;

    public const MIN_NAME = 5;
    public const MAX_NAME = 255;
    /** User Fields End */

    /** Event Fields Start */
    public const MIN_TITLE = 10;
    public const MAX_TITLE = 100;

    public const MIN_DESCRIPTION = 10;
    public const MAX_DESCRIPTION = 250;

    public const MIN_LOCATION = 10;
    public const MAX_LOCATION = 250;

    public const MIN_PRICE = 10;
    public const MAX_PRICE = 65000;

    public const MIN_ATTENDEE_LIMIT = 10;
    public const MAX_ATTENDEE_LIMIT = 65000;
    /** Event Fields End */
}
