<template>
    <!-- <Head title="Dashboard" /> -->

    <AuthenticatedLayout>
        <Header /> 

        <div class="main-heading">
            <h1>Your account</h1>
        </div>
        <nav>
            <div class="dropdown-container">
                <div class="profile nav-item filter-item active" data-filter="profile-personal"> 
                    Profile 
                    <i class="fa-solid fa-chevron-down"></i></div>
                <div class="dropdown">
                    <div class="dropdown-item filter-item " data-filter="profile-personal">Personal</div>
                    <div class="dropdown-item filter-item" data-filter="profile-password">Password</div>
                    <div class="dropdown-item filter-item" data-filter="profile-interests">Interests</div>
                </div>
            </div>
            <div class="billing nav-item filter-item" data-filter="billing">Billing</div>
            <div class="dropdown-container">
                <div class="profile nav-item filter-item " data-filter="order-notifications"> 
                    Settings 
                    <i class="fa-solid fa-chevron-down"></i>
                </div>
                <div class="dropdown">
                    <div class="dropdown-item filter-item " data-filter="order-notifications">Order notifications</div>
                    <div class="dropdown-item filter-item" data-filter="payment-settings">Payment settings</div> 
                </div>
            </div>
        </nav>
        <!-- Profile -->
        <div class="Profile--Personal account-item" data-item="profile-personal">
            <h2>Personal Informations</h2>
            <div class="inputs"> 
                <div class="element">
                    <label for="First Name"><span class="important">*</span>First Name</label>
                    <input type="text" name="First Name" value="Emmn">
                </div>
                <div class="element">
                    <label for="Phone number"><span class="important">*</span>Last Name</label>
                    <input type="text" name="Phone number" value="ket">
                </div>
                <div class="element">
                    <label for="Phone number"><span class="important">*</span>Phone number</label>
                    <input type="text" name="Phone number" placeholder="+23480000000">
                </div>
            </div>
            <div class="save">
                <div class="button">Save</div>
            </div>
        </div>
        <div class="Profile--Password hide account-item" data-item="profile-password">
            <h2>Update Password</h2>
            <div class="inputs"> 
                <div class="element">
                    <label><span class="important">*</span>Old password</label>
                    <input type="password" name="Old password">
                </div>
                <div class="element">
                    <label><span class="important">*</span>New password</label>
                    <input type="password" name="New password">
                </div>
                <div class="element">
                    <label><span class="important">*</span>Repeat new password</label>
                    <input type="password" name="Repeat new password" >
                </div>
            </div>
            <div class="save">
                <div class="button">Save</div>
            </div>
        </div>
        <div class="Profile--Interests hide account-item" data-item="profile-interests">
            <h2>Your interests</h2>
            <p>Select up to three categories that describe the events you organize</p>
            <!-- desktop user interests-->
            <div class="user-interests-desktop" id="user_interests">
                <div class="type">
                    <object data="../../assets/images/svgs/art.svg"></object>
                    <span class="name">Arts & Culture</span>
                </div>
                <div class="type">
                    <object data="../../assets/images/svgs/business.svg"></object>
                    <span class="name">Arts & Culture</span>
                </div>
                <div class="type active">
                    <object data="../../assets/images/svgs/career.svg"></object>
                    <span class="name">Arts & Culture</span>
                </div>
                <div class="type active">
                    <object data="../../assets/images/svgs/aid.svg"></object>
                    <span class="name">Arts & Culture</span>
                </div>
                <div class="type active">
                    <object data="../../assets/images/svgs/5.svg"></object>
                    <span class="name">Arts & Culture</span>
                </div>
                <div class="type">
                    <object data="../../assets/images/svgs/6.svg"></object>
                    <span class="name">Arts & Culture</span>
                </div>
                <div class="type">
                    <object data="../../assets/images/svgs/7.svg"></object>
                    <span class="name">Arts & Culture</span>
                </div>
                <div class="type">
                    <object data="../../assets/images/svgs/8.svg"></object>
                    <span class="name">Arts & Culture</span>
                </div>
                <div class="type">
                    <object data="../../assets/images/svgs/9.svg"></object>
                    <span class="name">Arts & Culture</span>
                </div>
                <div class="type">
                    <object data="../../assets/images/svgs/10.svg"></object>
                    <span class="name">Arts & Culture</span>
                </div>
                <div class="type">
                    <object data="../../assets/images/svgs/11.svg"></object>
                    <span class="name">Arts & Culture</span>
                </div>
                <div class="type">
                    <object data="../../assets/images/svgs/12.svg"></object>
                    <span class="name">Arts & Culture</span>
                </div>
                <div class="type">
                    <object data="../../assets/images/svgs/13.svg"></object>
                    <span class="name">Arts & Culture</span>
                </div>
                <div class="type">
                    <object data="../../assets/images/svgs/14.svg"></object>
                    <span class="name">Arts & Culture</span>
                </div>
                <div class="type">
                    <object data="../../assets/images/svgs/15.svg"></object>
                    <span class="name">Arts & Culture</span>
                </div>
                <div class="type">
                    <object data="../../assets/images/svgs/16.svg"></object>
                    <span class="name">Arts & Culture</span>
                </div>
                <div class="type">
                    <object data="../../assets/images/svgs/17.svg"></object>
                    <span class="name">Arts & Culture</span>
                </div>
            </div> 
            <!-- mobile user interests-->
            <div class="user-interests-mobile" id="user_interests">
                <!-- first -->
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
                <!-- second -->
                <select>
                    <option value="charity & aid">charity & aid</option>
                    <option value="arts & culture">arts & culture</option>
                    <option value="business">business</option>
                    <option value="career">career</option>
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
                <!-- third -->
                <select>
                    <option value="children & youth">children & youth</option>
                    <option value="arts & culture">arts & culture</option>
                    <option value="business">business</option>
                    <option value="career">career</option>
                    <option value="charity & aid">charity & aid</option>
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
            <div class="save">
                <div class="button">Save</div>
            </div>
        </div>
        <!-- Billing -->
        <div class="Billing account-item hide" data-item="billing">
            <h2>Personal Informations</h2> 
            <div class="current-plan">
                <div class="left">
                    <h3>Tix Free <i class="fa-solid fa-circle-exclamation"></i></h3>
                    <p>
                        <strong>You are on the free plan and charged nothing.</strong> <br>
                        Subscribe to Pro to get everything on the free plan plus lower transaction processing fees on paid tickets and more event management tools
                    </p>
                </div>
                <div class="right">
                    <div class="button">Upgrade Pro</div>
                </div>
            </div>
            <div class="invoices">
                <h2>Your invoices</h2>
                <p>You have no invoice history yet.</p>
            </div>
        </div>
        <!-- settings -->
        <div class="settings--order-notification account-item hide" data-item="order-notifications">
            <h2>Order Notifications</h2>
            <p>How frequently should we send order notifications by email?</p>
            <div class="options">
                <div class="element">
                    <input type="radio" name="order-notification-option" >
                    <label>Instantly, for each order as it comes in</label>
                </div>
                <div class="element">
                    <input type="radio" name="order-notification-option" >
                    <label>Daily summary, a daily summary of all orders sold each day</label>
                </div>
                <div class="element">
                    <input type="radio" name="order-notification-option" >
                    <label>Weekly summary, a weekly summary of all orders sold each week</label>
                </div>
                <div class="element">
                    <input type="radio" name="order-notification-option" >
                    <label>I do not want to receive order notifications</label>
                </div>
                <!-- save -->
                <div class="save">
                    <div class="button">Save</div>
                </div>
            </div>
        </div>
        <div class="settings--order-notification account-item hide" data-item="payment-settings">
            <h2>Payment Settings</h2>
            <p>How frequently should we send order notifications by email?</p>
            <div class="options">
                <div class="element">
                    <input type="radio" name="payment-settings-option" >
                    <label>Weekly, your payouts are batched and paid once a week on friday</label>
                </div>
                <!-- save -->
                <div class="save">
                    <div class="button">Save</div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>


<script setup>
import Header from '@/Components/dashboard/Header.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';


</script>