<template>
    <Master>
        <AuthenticatedLayout>
            <Header />

            <div class="main-heading">
                <div class="left">
                    <h1>{{ event.name }}</h1>
                    <!-- <p><i class="fa-solid fa-calendar-days"></i> Wed, Aug 17 2022 at 10:00 PM - 10:30 PM GDT (Greenland)</p> -->
                    <p><i class="fa-solid fa-calendar-days"></i> {{ event.start_date }} at {{ event.start_time }} - {{ event.end_date }} at {{ event.start_time }} </p> <!-- GDT (Greenland) -->
                    <p><i class="fa-solid fa-location-dot"></i> {{ event.location }}</p>
                </div>
                <div class="right">
                    <p class="top"><i class="fa-solid fa-circle-exclamation"></i> This event ended 20 days ago, to republish it:</p>
                    <p class="requirement"><span>Add payment details</span> so you can get paid</p>
                    <p class="requirement"><span>Create some tickets</span> for your event</p>
                    <p class="requirement">Update the <span>event date</span> </p>
                </div>
            </div>
            <nav>
                <div class="dropdown-container">
                    <div class="nav-item active filter-item" @click="activeTab='details'">
                        About
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>
                    <div class="dropdown">
                        <div class="dropdown-item filter-item" @click="activeTab='details'">Details</div>
                    </div>
                </div>
                <div class="dropdown-container">
                    <div class="nav-item filter-item" @click="activeTab='tickets'">
                        Tickets
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>
                    <div class="dropdown">
                        <div class="dropdown-item filter-item" @click="activeTab='tickets'">Tickets</div>
                        <div class="dropdown-item filter-item" @click="activeTab='discounts'">Discounts</div>
                        <div class="dropdown-item filter-item" @click="activeTab='ticket-email'">Ticket Email</div>
                    </div>
                </div>
                <div class="dropdown-container">
                    <div class="nav-item filter-item" @click="activeTab='appearances'">
                        Event page
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>
                    <div class="dropdown">
                        <div class="dropdown-item filter-item" @click="activeTab='appearances'">Appearances</div>
                    </div>
                </div>
                <div class="dropdown-container">
                    <div class="nav-item filter-item" @click="activeTab='guestlist'">
                        Manage guestlist
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>
                    <div class="dropdown">
                        <div class="dropdown-item filter-item" @click="activeTab='guestlist'">Guestlist</div>
                        <div class="dropdown-item filter-item" @click="activeTab='shedule'">Schedule</div>
                        <div class="dropdown-item filter-item" @click="activeTab='email-guestlist'">E-mail guestlist</div>
                    </div>
                </div>
                <div class="nav-item filter-item" @click="activeTab='sales'">Sales</div>
            </nav>

            <!-- Event Details -->
            <div class="event-details event-item " v-show="activeTab == 'details'">
                <h2>Event Details</h2>
                <div class="element">
                    <label for="name">*Event Name</label>
                    <input name="name" type="text">
                </div>
                <div class="element">
                    <label for="name">*Describe your event</label>
                    <div id="editor"></div>
                </div>
                <div class="element">
                    <label for="location">*Location of event</label>
                    <input name="location" type="text" placeholder="Full Adress">
                </div>
                <div class="element">
                    <label for="location">*Use Costum URL</label>
                    <div class="input-container">
                        <div class="startup">tix.africa/discover/</div>
                        <input name="url" type="url">
                    </div>
                </div>
                <div class="element">
                    <label for="location">*Location tips</label>
                    <input name="location" type="text" placeholder="Use an uber, it's the green building on the left, etc">
                </div>
                <h3>What kind of event is it?</h3>
                <p>Select the applicable category for your event</p>
                <!-- desktop kind of event -->
                <div class="kind-of-event ">
                    <div class="type active">
                        <object data="/backend/images/svgs/art.svg"></object>
                        <span class="name">Arts & Culture</span>
                    </div>
                    <div class="type">
                        <object data="/backend/images/svgs/business.svg"></object>
                        <span class="name">Arts & Culture</span>
                    </div>
                    <div class="type">
                        <object data="/backend/images/svgs/career.svg"></object>
                        <span class="name">Arts & Culture</span>
                    </div>
                    <div class="type">
                        <object data="/backend/images/svgs/aid.svg"></object>
                        <span class="name">Arts & Culture</span>
                    </div>
                    <div class="type">
                        <object data="/backend/images/svgs/5.svg"></object>
                        <span class="name">Arts & Culture</span>
                    </div>
                    <div class="type">
                        <object data="/backend/images/svgs/6.svg"></object>
                        <span class="name">Arts & Culture</span>
                    </div>
                    <div class="type">
                        <object data="/backend/images/svgs/7.svg"></object>
                        <span class="name">Arts & Culture</span>
                    </div>
                    <div class="type">
                        <object data="/backend/images/svgs/8.svg"></object>
                        <span class="name">Arts & Culture</span>
                    </div>
                    <div class="type">
                        <object data="/backend/images/svgs/9.svg"></object>
                        <span class="name">Arts & Culture</span>
                    </div>
                    <div class="type">
                        <object data="/backend/images/svgs/10.svg"></object>
                        <span class="name">Arts & Culture</span>
                    </div>
                    <div class="type">
                        <object data="/backend/images/svgs/11.svg"></object>
                        <span class="name">Arts & Culture</span>
                    </div>
                    <div class="type">
                        <object data="/backend/images/svgs/12.svg"></object>
                        <span class="name">Arts & Culture</span>
                    </div>
                    <div class="type">
                        <object data="/backend/images/svgs/13.svg"></object>
                        <span class="name">Arts & Culture</span>
                    </div>
                    <div class="type">
                        <object data="/backend/images/svgs/14.svg"></object>
                        <span class="name">Arts & Culture</span>
                    </div>
                    <div class="type">
                        <object data="/backend/images/svgs/15.svg"></object>
                        <span class="name">Arts & Culture</span>
                    </div>
                    <div class="type">
                        <object data="/backend/images/svgs/16.svg"></object>
                        <span class="name">Arts & Culture</span>
                    </div>
                    <div class="type">
                        <object data="/backend/images/svgs/17.svg"></object>
                        <span class="name">Arts & Culture</span>
                    </div>
                </div>
                <!-- mobile kind of event -->
                <div class="element mobile">
                    <select>
                        <option value="arts & culture">arts & culture</option>
                        <option value="business">business</option>
                        <option value="career">career</option>
                        <option value="charity & aid">charity & aid</option>
                        <option value="children & youth">children & youth</option>
                        <option value="community">community</option>
                        <option value="fashion & design">fashion & design</option>
                        <option value="food & drink">food & drink</option>
                        <option value="goverment">goverment</option>
                        <option value="investments">investments</option>
                        <option value="media & film">media & film</option>
                        <option value="music & performances">music & performances</option>
                        <option value="schools & education">schools & education</option>
                        <option value="spirituality & religion">spirituality & religion</option>
                        <option value="sports & fitness">sports & fitness</option>
                        <option value="startups & smallbusiness">startups & smallbusiness</option>
                        <option value="technology & science">technology & science</option>
                    </select>
                </div>
                <h3>When is your event?</h3>
                <p>Select all the dates of your event</p>
                <div class="when">
                    <div class="btns">
                        <div class="btn active">Single Event</div>
                        <div class="btn pro">Recurring Event</div>
                        <div class="btn pro">One-on-One</div>
                    </div>
                    <div class="element mobile">
                        <select>
                            <option value="Single Event">Single Event</option>
                            <option value="Recurring Event">Recurring Event</option>
                            <option value="One-on-One">One-on-One</option>
                        </select>
                    </div>
                    <div class="element">
                        <label for="location">*Select TimeZone</label>
                        <select>
                            <option data-time-zone-id="1" data-gmt-adjustment="GMT-12:00" data-use-daylight="0" value="-12">(GMT-12:00) International Date Line West</option>
                            <option data-time-zone-id="2" data-gmt-adjustment="GMT-11:00" data-use-daylight="0" value="-11">(GMT-11:00) Midway Island, Samoa</option>
                            <option data-time-zone-id="3" data-gmt-adjustment="GMT-10:00" data-use-daylight="0" value="-10">(GMT-10:00) Hawaii</option>
                            <option data-time-zone-id="4" data-gmt-adjustment="GMT-09:00" data-use-daylight="1" value="-9">(GMT-09:00) Alaska</option>
                            <option data-time-zone-id="5" data-gmt-adjustment="GMT-08:00" data-use-daylight="1" value="-8">(GMT-08:00) Pacific Time (US & Canada)</option>
                            <option data-time-zone-id="6" data-gmt-adjustment="GMT-08:00" data-use-daylight="1" value="-8">(GMT-08:00) Tijuana, Baja California</option>
                            <option data-time-zone-id="7" data-gmt-adjustment="GMT-07:00" data-use-daylight="0" value="-7">(GMT-07:00) Arizona</option>
                            <option data-time-zone-id="8" data-gmt-adjustment="GMT-07:00" data-use-daylight="1" value="-7">(GMT-07:00) Chihuahua, La Paz, Mazatlan</option>
                            <option data-time-zone-id="9" data-gmt-adjustment="GMT-07:00" data-use-daylight="1" value="-7">(GMT-07:00) Mountain Time (US & Canada)</option>
                            <option data-time-zone-id="10" data-gmt-adjustment="GMT-06:00" data-use-daylight="0" value="-6">(GMT-06:00) Central America</option>
                            <option data-time-zone-id="11" data-gmt-adjustment="GMT-06:00" data-use-daylight="1" value="-6">(GMT-06:00) Central Time (US & Canada)</option>
                            <option data-time-zone-id="12" data-gmt-adjustment="GMT-06:00" data-use-daylight="1" value="-6">(GMT-06:00) Guadalajara, Mexico City, Monterrey</option>
                            <option data-time-zone-id="13" data-gmt-adjustment="GMT-06:00" data-use-daylight="0" value="-6">(GMT-06:00) Saskatchewan</option>
                            <option data-time-zone-id="14" data-gmt-adjustment="GMT-05:00" data-use-daylight="0" value="-5">(GMT-05:00) Bogota, Lima, Quito, Rio Branco</option>
                            <option data-time-zone-id="15" data-gmt-adjustment="GMT-05:00" data-use-daylight="1" value="-5">(GMT-05:00) Eastern Time (US & Canada)</option>
                            <option data-time-zone-id="16" data-gmt-adjustment="GMT-05:00" data-use-daylight="1" value="-5">(GMT-05:00) Indiana (East)</option>
                            <option data-time-zone-id="17" data-gmt-adjustment="GMT-04:00" data-use-daylight="1" value="-4">(GMT-04:00) Atlantic Time (Canada)</option>
                            <option data-time-zone-id="18" data-gmt-adjustment="GMT-04:00" data-use-daylight="0" value="-4">(GMT-04:00) Caracas, La Paz</option>
                            <option data-time-zone-id="19" data-gmt-adjustment="GMT-04:00" data-use-daylight="0" value="-4">(GMT-04:00) Manaus</option>
                            <option data-time-zone-id="20" data-gmt-adjustment="GMT-04:00" data-use-daylight="1" value="-4">(GMT-04:00) Santiago</option>
                            <option data-time-zone-id="21" data-gmt-adjustment="GMT-03:30" data-use-daylight="1" value="-3.5">(GMT-03:30) Newfoundland</option>
                            <option data-time-zone-id="22" data-gmt-adjustment="GMT-03:00" data-use-daylight="1" value="-3">(GMT-03:00) Brasilia</option>
                            <option data-time-zone-id="23" data-gmt-adjustment="GMT-03:00" data-use-daylight="0" value="-3">(GMT-03:00) Buenos Aires, Georgetown</option>
                            <option data-time-zone-id="24" data-gmt-adjustment="GMT-03:00" data-use-daylight="1" value="-3">(GMT-03:00) Greenland</option>
                            <option data-time-zone-id="25" data-gmt-adjustment="GMT-03:00" data-use-daylight="1" value="-3">(GMT-03:00) Montevideo</option>
                            <option data-time-zone-id="26" data-gmt-adjustment="GMT-02:00" data-use-daylight="1" value="-2">(GMT-02:00) Mid-Atlantic</option>
                            <option data-time-zone-id="27" data-gmt-adjustment="GMT-01:00" data-use-daylight="0" value="-1">(GMT-01:00) Cape Verde Is.</option>
                            <option data-time-zone-id="28" data-gmt-adjustment="GMT-01:00" data-use-daylight="1" value="-1">(GMT-01:00) Azores</option>
                            <option data-time-zone-id="29" data-gmt-adjustment="GMT+00:00" data-use-daylight="0" value="0">(GMT+00:00) Casablanca, Monrovia, Reykjavik</option>
                            <option data-time-zone-id="30" data-gmt-adjustment="GMT+00:00" data-use-daylight="1" value="0">(GMT+00:00) Greenwich Mean Time : Dublin, Edinburgh, Lisbon, London</option>
                            <option data-time-zone-id="31" data-gmt-adjustment="GMT+01:00" data-use-daylight="1" value="1">(GMT+01:00) Amsterdam, Berlin, Bern, Rome, Stockholm, Vienna</option>
                            <option data-time-zone-id="32" data-gmt-adjustment="GMT+01:00" data-use-daylight="1" value="1">(GMT+01:00) Belgrade, Bratislava, Budapest, Ljubljana, Prague</option>
                            <option data-time-zone-id="33" data-gmt-adjustment="GMT+01:00" data-use-daylight="1" value="1">(GMT+01:00) Brussels, Copenhagen, Madrid, Paris</option>
                            <option data-time-zone-id="34" data-gmt-adjustment="GMT+01:00" data-use-daylight="1" value="1">(GMT+01:00) Sarajevo, Skopje, Warsaw, Zagreb</option>
                            <option data-time-zone-id="35" data-gmt-adjustment="GMT+01:00" data-use-daylight="1" value="1">(GMT+01:00) West Central Africa</option>
                            <option data-time-zone-id="36" data-gmt-adjustment="GMT+02:00" data-use-daylight="1" value="2">(GMT+02:00) Amman</option>
                            <option data-time-zone-id="37" data-gmt-adjustment="GMT+02:00" data-use-daylight="1" value="2">(GMT+02:00) Athens, Bucharest, Istanbul</option>
                            <option data-time-zone-id="38" data-gmt-adjustment="GMT+02:00" data-use-daylight="1" value="2">(GMT+02:00) Beirut</option>
                            <option data-time-zone-id="39" data-gmt-adjustment="GMT+02:00" data-use-daylight="1" value="2">(GMT+02:00) Cairo</option>
                            <option data-time-zone-id="40" data-gmt-adjustment="GMT+02:00" data-use-daylight="0" value="2">(GMT+02:00) Harare, Pretoria</option>
                            <option data-time-zone-id="41" data-gmt-adjustment="GMT+02:00" data-use-daylight="1" value="2">(GMT+02:00) Helsinki, Kyiv, Riga, Sofia, Tallinn, Vilnius</option>
                            <option data-time-zone-id="42" data-gmt-adjustment="GMT+02:00" data-use-daylight="1" value="2">(GMT+02:00) Jerusalem</option>
                            <option data-time-zone-id="43" data-gmt-adjustment="GMT+02:00" data-use-daylight="1" value="2">(GMT+02:00) Minsk</option>
                            <option data-time-zone-id="44" data-gmt-adjustment="GMT+02:00" data-use-daylight="1" value="2">(GMT+02:00) Windhoek</option>
                            <option data-time-zone-id="45" data-gmt-adjustment="GMT+03:00" data-use-daylight="0" value="3">(GMT+03:00) Kuwait, Riyadh, Baghdad</option>
                            <option data-time-zone-id="46" data-gmt-adjustment="GMT+03:00" data-use-daylight="1" value="3">(GMT+03:00) Moscow, St. Petersburg, Volgograd</option>
                            <option data-time-zone-id="47" data-gmt-adjustment="GMT+03:00" data-use-daylight="0" value="3">(GMT+03:00) Nairobi</option>
                            <option data-time-zone-id="48" data-gmt-adjustment="GMT+03:00" data-use-daylight="0" value="3">(GMT+03:00) Tbilisi</option>
                            <option data-time-zone-id="49" data-gmt-adjustment="GMT+03:30" data-use-daylight="1" value="3.5">(GMT+03:30) Tehran</option>
                            <option data-time-zone-id="50" data-gmt-adjustment="GMT+04:00" data-use-daylight="0" value="4">(GMT+04:00) Abu Dhabi, Muscat</option>
                            <option data-time-zone-id="51" data-gmt-adjustment="GMT+04:00" data-use-daylight="1" value="4">(GMT+04:00) Baku</option>
                            <option data-time-zone-id="52" data-gmt-adjustment="GMT+04:00" data-use-daylight="1" value="4">(GMT+04:00) Yerevan</option>
                            <option data-time-zone-id="53" data-gmt-adjustment="GMT+04:30" data-use-daylight="0" value="4.5">(GMT+04:30) Kabul</option>
                            <option data-time-zone-id="54" data-gmt-adjustment="GMT+05:00" data-use-daylight="1" value="5">(GMT+05:00) Yekaterinburg</option>
                            <option data-time-zone-id="55" data-gmt-adjustment="GMT+05:00" data-use-daylight="0" value="5">(GMT+05:00) Islamabad, Karachi, Tashkent</option>
                            <option data-time-zone-id="56" data-gmt-adjustment="GMT+05:30" data-use-daylight="0" value="5.5">(GMT+05:30) Sri Jayawardenapura</option>
                            <option data-time-zone-id="57" data-gmt-adjustment="GMT+05:30" data-use-daylight="0" value="5.5">(GMT+05:30) Chennai, Kolkata, Mumbai, New Delhi</option>
                            <option data-time-zone-id="58" data-gmt-adjustment="GMT+05:45" data-use-daylight="0" value="5.75">(GMT+05:45) Kathmandu</option>
                            <option data-time-zone-id="59" data-gmt-adjustment="GMT+06:00" data-use-daylight="1" value="6">(GMT+06:00) Almaty, Novosibirsk</option>
                            <option data-time-zone-id="60" data-gmt-adjustment="GMT+06:00" data-use-daylight="0" value="6">(GMT+06:00) Astana, Dhaka</option>
                            <option data-time-zone-id="61" data-gmt-adjustment="GMT+06:30" data-use-daylight="0" value="6.5">(GMT+06:30) Yangon (Rangoon)</option>
                            <option data-time-zone-id="62" data-gmt-adjustment="GMT+07:00" data-use-daylight="0" value="7">(GMT+07:00) Bangkok, Hanoi, Jakarta</option>
                            <option data-time-zone-id="63" data-gmt-adjustment="GMT+07:00" data-use-daylight="1" value="7">(GMT+07:00) Krasnoyarsk</option>
                            <option data-time-zone-id="64" data-gmt-adjustment="GMT+08:00" data-use-daylight="0" value="8">(GMT+08:00) Beijing, Chongqing, Hong Kong, Urumqi</option>
                            <option data-time-zone-id="65" data-gmt-adjustment="GMT+08:00" data-use-daylight="0" value="8">(GMT+08:00) Kuala Lumpur, Singapore</option>
                            <option data-time-zone-id="66" data-gmt-adjustment="GMT+08:00" data-use-daylight="0" value="8">(GMT+08:00) Irkutsk, Ulaan Bataar</option>
                            <option data-time-zone-id="67" data-gmt-adjustment="GMT+08:00" data-use-daylight="0" value="8">(GMT+08:00) Perth</option>
                            <option data-time-zone-id="68" data-gmt-adjustment="GMT+08:00" data-use-daylight="0" value="8">(GMT+08:00) Taipei</option>
                            <option data-time-zone-id="69" data-gmt-adjustment="GMT+09:00" data-use-daylight="0" value="9">(GMT+09:00) Osaka, Sapporo, Tokyo</option>
                            <option data-time-zone-id="70" data-gmt-adjustment="GMT+09:00" data-use-daylight="0" value="9">(GMT+09:00) Seoul</option>
                            <option data-time-zone-id="71" data-gmt-adjustment="GMT+09:00" data-use-daylight="1" value="9">(GMT+09:00) Yakutsk</option>
                            <option data-time-zone-id="72" data-gmt-adjustment="GMT+09:30" data-use-daylight="0" value="9.5">(GMT+09:30) Adelaide</option>
                            <option data-time-zone-id="73" data-gmt-adjustment="GMT+09:30" data-use-daylight="0" value="9.5">(GMT+09:30) Darwin</option>
                            <option data-time-zone-id="74" data-gmt-adjustment="GMT+10:00" data-use-daylight="0" value="10">(GMT+10:00) Brisbane</option>
                            <option data-time-zone-id="75" data-gmt-adjustment="GMT+10:00" data-use-daylight="1" value="10">(GMT+10:00) Canberra, Melbourne, Sydney</option>
                            <option data-time-zone-id="76" data-gmt-adjustment="GMT+10:00" data-use-daylight="1" value="10">(GMT+10:00) Hobart</option>
                            <option data-time-zone-id="77" data-gmt-adjustment="GMT+10:00" data-use-daylight="0" value="10">(GMT+10:00) Guam, Port Moresby</option>
                            <option data-time-zone-id="78" data-gmt-adjustment="GMT+10:00" data-use-daylight="1" value="10">(GMT+10:00) Vladivostok</option>
                            <option data-time-zone-id="79" data-gmt-adjustment="GMT+11:00" data-use-daylight="1" value="11">(GMT+11:00) Magadan, Solomon Is., New Caledonia</option>
                            <option data-time-zone-id="80" data-gmt-adjustment="GMT+12:00" data-use-daylight="1" value="12">(GMT+12:00) Auckland, Wellington</option>
                            <option data-time-zone-id="81" data-gmt-adjustment="GMT+12:00" data-use-daylight="0" value="12">(GMT+12:00) Fiji, Kamchatka, Marshall Is.</option>
                            <option data-time-zone-id="82" data-gmt-adjustment="GMT+13:00" data-use-daylight="0" value="13">(GMT+13:00) Nuku'alofa</option>
                        </select>
                    </div>
                    <div class="element">
                        <label for="location">*Start date</label>
                        <div class="date-time">
                            <input type="date">
                            <input type="time">
                        </div>
                    </div>
                    <div class="element">
                        <label for="location">*End date</label>
                        <div class="date-time">
                            <input type="date">
                            <input type="time">
                        </div>
                    </div>
                </div>
                <h2>Social details</h2>
                <div class="element">
                    <div class="input-container">
                        <div class="startup"><i class="fa-solid fa-link"></i></div>
                        <input name="Website" type="url" placeholder="Your Website URL">
                    </div>
                </div>
                <div class="element">
                    <div class="input-container">
                        <div class="startup"><i class="fa-brands fa-instagram"></i></div>
                        <input name="instagram" type="url" placeholder="Your Instagram Handle">
                    </div>
                </div>
                <div class="element">
                    <div class="input-container">
                        <div class="startup"><i class="fa-brands fa-twitter"></i></div>
                        <input name="twitter" type="url" placeholder="Your Twitter Handle">
                    </div>
                </div>
                <div class="element">
                    <div class="input-container">
                        <div class="startup"><i class="fa-brands fa-facebook-f"></i></div>
                        <input name="facebook" type="url" placeholder="Your Facebook Handle">
                    </div>
                </div>
                <!-- Continue Buttons -->
                <div class="save-or-cancel">
                    <div class="button save">Save</div>
                </div>
            </div>
            <!-- tickets -->
            <div class="tickets-tickets event-item" v-show="activeTab == 'tickets'">
                <div class="note">
                    <a href="#">Tix is free to use for free events. If you’re charging guests a fee, we charge a percentage of the value of ticket as a transaction processing fee.</a>
                </div>
                <div class="make-tickets">
                    <img src="/backend/images/ticket-create.svg" alt="Ticket Create">
                    <h5>Let's create tickets</h5>
                    <p>You don't have any tickets created yet, create your first ticket - it will only take 1 minute</p>
                    <div class="button" id="trigger_make_ticket" @click="showPopup=true">
                        Add Ticket <i class="fa-solid fa-plus"></i>
                    </div>
                </div>
            </div>
            <!-- discount -->
            <div class="discount event-item" v-show="activeTab == 'discounts'">
                <div class="create-discount">
                    <img src="/backend/images/discount.svg" alt="Ticket Create">
                    <h5>Create discount codes and automatic discounts</h5>
                    <p>No discounts created yet, create a paid ticket first so that you can create a discount</p>
                </div>
            </div>
            <!-- ticket email -->
            <div class="ticket-email event-item" v-show="activeTab == 'ticket-email'">
                <h2>Customize ticket e-mail</h2>
                <div class="element">
                    <label for="name">*Message for ticket email</label>
                    <div id="editor-email"></div>
                    <form>
                        <div class="element">
                            <label for="name">*E-mail address to send test</label>
                            <input type="email">
                        </div>
                        <input type="submit" value="Send test">
                    </form>
                </div>
            </div>
            <!-- event page -> appearances -->
            <div class="event-page-appearances event-item" v-show="activeTab == 'appearances'">
                <h2>Event Page Theme</h2>
                <div class="event-themes">
                    <div class="event-theme">
                        <div class="theme">
                            <div class="left">
                                <span class="in-use">In use</span>
                                <h4>Default</h4>
                                <div class="buttons">
                                    <div class="button">Select</div>
                                    <div class="button light">Preview</div>
                                </div>
                            </div>
                            <div class="right">
                                <img src="/backend/images/theme-free.png" alt="">
                            </div>
                        </div>
                        <div class="theme">
                            <div class="left">
                                <img src="/backend/images/star-bars.svg" alt="" class="pro">
                                <h4>Default</h4>
                                <div class="buttons">
                                    <div class="button">Select</div>
                                    <div class="button light">Preview</div>
                                </div>
                            </div>
                            <div class="right">
                                <img src="/backend/images/theme-pro-1.png" alt="">
                            </div>
                        </div>
                        <div class="theme">
                            <div class="left">
                                <img src="/backend/images/star-bars.svg" alt="" class="pro">
                                <h4>Default</h4>
                                <div class="buttons">
                                    <div class="button">Select</div>
                                    <div class="button light">Preview</div>
                                </div>
                            </div>
                            <div class="right">
                                <img src="/backend/images/theme-pro-2.png" alt="">
                            </div>
                        </div>
                        <div class="theme">
                            <div class="left">
                                <img src="/backend/images/star-bars.svg" alt="" class="pro">
                                <h4>Default</h4>
                                <div class="buttons">
                                    <div class="button">Select</div>
                                    <div class="button light">Preview</div>
                                </div>
                            </div>
                            <div class="right">
                                <img src="/backend/images/theme-pro-3.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <h2>Event Image</h2>
                <p>Upload a JPEG or PNG file: Images with a 2:1 ratio (a short rectangle) look the best in the defaultheme</p>
                <div class="event-image-section">
                    <img src="/backend/images/digital-marketing.png" id="output" />
                    <input type="file" accept="image/*" onchange="loadFile(event)">
                </div>
                <!-- save-->
                <div class="save-or-cancel">
                    <div class="button save">Save</div>
                </div>
            </div>
            <!-- Guestlist -->
            <div class="guestlist event-item" v-show="activeTab == 'guestlist'">
                <h1>Guestlist</h1>
                <p>There are no guests yet</p>
                <div class="button">Export</div>
            </div>
            <!-- shedule -->
            <div class="shedule event-item" v-show="activeTab == 'shedule'">
                <div class="shedule-container">
                    <p>Schedules are only available for one on one events</p>
                    <a href="#">Learn more about one on one events</a>
                </div>
            </div>
            <!-- email guestlist -->
            <div class="email-guestlist event-item" v-show="activeTab == 'email-guestlist'">
                <h2>E-mail guestlist</h2>
                <p>There are no attendees yet</p>
            </div>
            <!-- sales -->
            <div class="sales event-item" v-show="activeTab == 'sales'">
                <div class="sales-container">
                    <div class="column">
                        <div class="number">0</div>
                        <div class="name">Tickets sold</div>
                    </div>
                    <div class="column">
                        <div class="number">$0.00</div>
                        <div class="name">Sales revenue</div>
                    </div>
                    <div class="column">
                        <div class="number">-</div>
                        <div class="name">Next payout date</div>
                    </div>
                </div>
                <div class="text">
                    <h2>Sales</h2>
                    <p>There are no sales yet</p>
                </div>
                <div class="text">
                    <h2>Payment history</h2>
                    <p>There are no payouts yet</p>
                </div>
            </div>
            <TicketCreatePopup v-model="showPopup"></TicketCreatePopup>
        </AuthenticatedLayout>
    </Master>
</template>


<script setup>
import { ref } from '@vue/reactivity';
import Header from '@/Components/dashboard/Header.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import TicketCreatePopup from '@/Components/dashboard/popup/TicketCreatePopup.vue';
import Master from './Master.vue';
const showPopup = ref(false)
const activeTab = ref('details');

const props = defineProps({
    event: Object,
});


</script>