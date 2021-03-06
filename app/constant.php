<?php

namespace App;

class Constant
{
    const EMPTY_ROOM_STATUS = 1;
    const RENTED_ROOM_STATUS = 2;
    const BOOKED_ROOM_STATUS = 3;
    const DIRTY_ROOM_STATUS = 4;
    const REPAIRED_ROOM_STATUS = 5;
    const PRE_STR_BILL_NAME = 'TTP';
    const PRE_STR_BOOKING_NAME = 'DP';
    const PRE_STR_IMPORT_RECEIPT_NAME = 'PNK';
    const PRE_STR_EXPORT_RECEIPT_NAME = 'PXK';
    const PRE_STR_IMPORT_BUDGET_NAME = 'PTQ';
    const PRE_STR_EXPORT_BUDGET_NAME = 'PXQ';

    const IMPORT_BUDGET_INVOICE_ID = 1;
    const EXPORT_BUDGET_INVOICE_ID = 2;


    const IMPORT_RECEIPT_ID = 1;
    const EXPORT_RECEIPT_ID = 2;

    const TIME_CHECKIN = '14:00:00';
    const TIME_CHECKOUT = '12:00:00';
    const ROUNDING_TIME_ROOM_MINUTE = 15;

    const TIME_EARLY_CHECKIN_1_HOURS = 2;
    const TIME_CHECKIN_1_RATIO = 0;

    const TIME_EARLY_CHECKIN_2_HOURS = 5;
    const TIME_CHECKIN_2_RATIO = 0.5;

    const TIME_EARLY_CHECKIN_3_HOURS = 9;
    const TIME_CHECKIN_3_RATIO = 0.3;



    const TIME_LATE_CHECKOUT_1_HOURS = 3;
    const TIME_CHECKOUT_1_RATIO = 0.3;

    const TIME_LATE_CHECKOUT_2_HOURS = 6;
    const TIME_CHECKOUT_2_RATIO = 0.5;

    const ROUNDING_SHIFT_MINUTE_TIME = 15;

    const MANAGER_ID = 1;
    CONST RECEPTIONIST_ID = 2;
    CONST CASHIER_ID = 3;
    CONST STOCKKEEPER_ID = 4;
    CONST ACCOUNTANT_ID = 5;
    const TREASURER_ID = 6;

}
