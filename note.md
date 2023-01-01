
<!-- target 24-12-2022 -->





::Trying to forgot.
    -- zoom link generate
    -- ticket question




✅1: Logout
✅2: Advertise image like banner image
✅3: Featured advertise
✅4: send featured ad on frontend
✅5: Implement user_id
✅6: advertise can manage by admin
✅7: admin comission on dashboard
✅8: if user type is admin show admin panel, if organizer show ............. 

::: if admin
--widget:
    ✅total event
    ✅total organiser
    ✅total client
    ✅commission
    ✅total sell amount
    ✅all events
    ✅total views
    ✅cant create event

::: if organizer
--widget:
    ✅total event created by him
    ✅commission charge
    ✅total tickets
    ✅total sell




///////////////////////

::: update
    -- ✅3 top selling ticket sent to frontend
    -- ✅admin dashboard show organizer on event card
    -- ✅total organizer on widget
    -- ✅advertise position number and send as asc order
    -- ✅advertise time limit (start date, end date)
    -- ✅update advertise to disable when out of date
    -- ✅remove view all from top selling section
    -- ✅Hot offer slider and remove view all from there
    -- ✅category carosel padding
    -- ✅event details manage guest list
    -- ✅guest management
    -- ✅organizer manage with payment system

    -- site settings
        -- ✅logo, banner image, title
        -- ✅search page 
        -- ✅date range
        -- ✅ticket min max price
        -- ✅admin can set currency and commission


:: from video
    -- ✅while event creating: start date should not be > end date
    -- ✅event details page duration
    -- ✅event edit page (create some ticket for your event) if any event exist it should be hidden

    -- ✅track visitor ip and location (video on 24 min)
        :help https://medium.com/@laraveltuts/ how-to-get-country-city-address-from-ip-address-laravel-9-e20c82200702

:: for online event
    -- generate zome meeting
    https://marketplace.zoom.us/docs/sdk/video/web/get-started/#install-from-npm

:: ✅bank
    bank name
    account number
    account name
    branch name

    paypal info
    stripe info
    more info


:: ticket 


24:meeting:
 -- ✅user profile update
    -- ✅name, phone, etc.
 -- ✅ticket sold list, spalling mistack for price
 -- ✅use datatable on sold ticket list
 -- ✅ticket sold date
 -- ✅next payout date is after one week from event end date
 -- ✅event details page, change date formate to d-m-y
 :: ✅payment info
    -- ✅for m-pesa only need phone number
    -- ✅remove stripe information 
    -- ✅instade of account number rename it with (IBAN number)
    -- ✅instade of account name rename it with (BIC)
    -- ✅account information
        ✅use 3 card for (bank info, paypal info and mpesa info)
        ✅only one account information will add (update otherwise)
        ✅remove delete button form account information
-- ✅remove compare percent from widgets
-- ✅currency will placed after amount with space.
    -- ✅commission implement from backend.
-- ✅from payment method page, remove serves & handling

-- ✅ticket code scane by camera and update status to checkin.(already used ticket)
    ✅vue qrcode reader
    https://gruhn.github.io/vue-qrcode-reader/


    -- ✅hide paypal and m-pesa if not available. (justify-center)

    -- ✅if not login show login popup on card add.

    ::footer
        footer_top_part:
            ✅logo
            --✅Imprint, Data privacy, Terms & conditions
        bootm_footer:
            -- ✅witter, Facebook, Tiktok, Instagram, Youtube, Telegram, Copy write text
        ✅(Dynamic from backend)

-- ✅while scanning (Check if he is woner of this ticket)
    ✅invalid, expired, used, validated

database:
    ✅sales
        sales details
        ticket_numbers