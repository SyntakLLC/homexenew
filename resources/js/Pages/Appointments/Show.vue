<template>
    <app-layout :title="appointment.title">
        <template #header>
            <div class="justify-between flex">
                <h2 class="font-semibold text-xl text-gray-100 leading-tight">
                    {{ appointment.title }}
                </h2>
            </div>
        </template>

        <!-- Form details -->
        <div v-if="appointment.status" class="flex max-w-4xl mx-auto">
            <DescriptionList
                class="mt-4 mb-12 min-w-full"
                :title="appointment.location"
                :subtitle="appointment.description">
                <template #questions>
                    <DescriptionListItem
                        question="Appointment Status"
                        :answer="convertAnswer(Status, appointment.status)" />
                    <DescriptionListItem
                        question="Appointment Type"
                        :answer="
                            convertAnswer(
                                AppointmentType,
                                appointment.appointment_type,
                            )
                        " />

                    <div v-if="appointment.seller_actually_selling">
                        <DescriptionListItem
                            question="Is the Seller Actually Selling?"
                            :answer="
                                convertAnswer(
                                    SellerActuallySelling,
                                    appointment.seller_actually_selling,
                                )
                            " />
                        <DescriptionListItem
                            question="Reason for Selling"
                            :answer="
                                convertAnswer(
                                    ReasonForSelling,
                                    appointment.reason_for_selling,
                                )
                            " />
                        <DescriptionListItem
                            question="House Condition"
                            :answer="
                                convertAnswer(
                                    HouseCondition,
                                    appointment.house_condition,
                                )
                            " />
                        <DescriptionListItem
                            question="Seller asking price:"
                            :answer="
                                numberWithCommas(
                                    appointment.seller_asking_price,
                                )
                            " />
                        <DescriptionListItem
                            question="Lowest the seller may consider:"
                            :answer="
                                numberWithCommas(
                                    appointment.lowest_considered_price,
                                )
                            " />
                        <DescriptionListItem
                            question="Roughly what would the property sell for on MLS in current condition?"
                            :answer="numberWithCommas(appointment.mls_price)" />
                        <DescriptionListItem
                            question="Timeframe for Selling"
                            :answer="
                                convertAnswer(
                                    TimeframeForSelling,
                                    appointment.timeframe_for_selling,
                                )
                            " />
                        <DescriptionListItem
                            question="Seller Avatar"
                            :answer="
                                convertAnswer(
                                    SellerAvatar,
                                    appointment.seller_avatar,
                                )
                            " />
                        <DescriptionListItem
                            question="Odds of Conversion"
                            :answer="
                                convertAnswer(
                                    OddsOfConversion,
                                    appointment.odds_of_conversion,
                                )
                            " />
                    </div>

                    <div v-else>
                        <DescriptionListItem
                            question="Is the Buyer Serious About Buying?"
                            :answer="
                                convertAnswer(
                                    BuyerSeriousAboutBuying,
                                    appointment.buyer_serious_about_buying,
                                )
                            " />
                        <DescriptionListItem
                            question="Rough idea of their credit"
                            :answer="
                                convertAnswer(
                                    BuyerCredit,
                                    appointment.buyer_credit,
                                )
                            " />
                        <DescriptionListItem
                            question="Preapproved?"
                            :answer="appointment.preapproved" />
                        <DescriptionListItem
                            question="Did you refer a lender, and if so, what lender?"
                            :answer="appointment.lender" />
                        <DescriptionListItem
                            question="What are the top 2 towns they are searching in?"
                            :answer="appointment.top_two_towns" />
                        <DescriptionListItem
                            question="Roughly what is their desired price point?"
                            :answer="
                                numberWithCommas(
                                    appointment.desired_price_point,
                                )
                            " />
                        <DescriptionListItem
                            question="Timeframe for Selling"
                            :answer="
                                convertAnswer(
                                    TimeframeForSelling,
                                    appointment.timeframe_for_selling,
                                )
                            " />
                        <DescriptionListItem
                            question="Do they need to sell before they buy?"
                            :answer="appointment.sell_before_buy" />
                        <DescriptionListItem
                            question="Odds of Conversion"
                            :answer="
                                convertAnswer(
                                    OddsOfConversion,
                                    appointment.odds_of_conversion,
                                )
                            " />
                    </div>
                </template>
            </DescriptionList>
        </div>

        <!-- User has not filled out the form -->
        <div v-else class="w-full h-full">
            <div class="max-w-4xl mx-auto pt-40 text-center">
                <main class="sm:flex">
                    <div class="mx-auto">
                        <div class="text-center">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="mx-auto h-12 w-12 text-gray-400"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.5"
                                    d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>

                            <h3 class="mt-2 text-sm font-medium text-gray-900">
                                Hold on!
                            </h3>
                            <p class="mt-1 text-sm text-gray-500">
                                You haven't filled out this appointment's
                                details yet.
                            </p>
                            <div class="mt-6">
                                <button
                                    type="button"
                                    class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <!--                                     <PlusIcon
                                        class="-ml-1 mr-2 h-5 w-5"
                                        aria-hidden="true" /> -->
                                    <a
                                        :href="
                                            route(
                                                'appointment.edit',
                                                appointment,
                                            )
                                        ">
                                        Fill out
                                    </a>
                                </button>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '../../Layouts/AppLayout';
    import DescriptionList from '../Components/DescriptionList';
    import DescriptionListItem from '../Components/DescriptionListItem';
    import { PlusIcon } from '@heroicons/vue/solid';

    const Status = Object.freeze({
        Conducted: 1,
        Cancelled: 2,
        Rescheduled: 3,
    });
    const AppointmentType = Object.freeze({
        'Retail Seller': 1,
        'Cash Offer': 2,
        Buyer: 3,
    });

    // seller consts
    const SellerActuallySelling = Object.freeze({ Yes: 1, No: 2, Maybe: 3 });
    const ReasonForSelling = Object.freeze({
        Downsizing: 1,
        Upgrading: 2,
        Relocating: 3,
        Inheritance: 4,
        'Tired of Being a Landlord': 5,
        "Can't Afford Current House": 6,
        'Current House Needs too Much Work': 7,
    });
    const HouseCondition = Object.freeze({
        Poor: 1,
        Fair: 2,
        Average: 3,
        Good: 4,
        Excellent: 5,
    });
    const TimeframeForSelling = Object.freeze({
        'Within 1 Month': 1,
        '1 to 3 Months': 2,
        '3 to 6 Months': 3,
        '6 to 12 Months': 4,
        '1 to 2 Years': 5,
        '2+ Years': 6,
        Never: 7,
    });
    const SellerAvatar = Object.freeze({
        'Sell to Investor': 1,
        'List their Home': 2,
        'Top dollar without listing': 3,
        'Just curious': 4,
    });
    const OddsOfConversion = Object.freeze({
        '100%': 1,
        '80%': 2,
        '60%': 3,
        '40%': 4,
        '20%': 5,
        '0%': 6,
    });

    // buyer consts
    const BuyerSeriousAboutBuying = Object.freeze({
        Yes: 1,
        No: 2,
        Maybe: 3,
        Unqualified: 4,
    });
    const BuyerCredit = Object.freeze({
        Poor: 1,
        Fair: 2,
        Average: 3,
        Good: 4,
        Excellent: 5,
    });

    export default {
        name: 'Show.vue',
        components: {
            DescriptionListItem,
            DescriptionList,
            AppLayout,
            PlusIcon,
        },

        props: ['appointment'],

        data() {
            return {
                // consts
                Status,
                AppointmentType,
                SellerActuallySelling,
                ReasonForSelling,
                HouseCondition,
                TimeframeForSelling,
                SellerAvatar,
                OddsOfConversion,
                BuyerSeriousAboutBuying,
                BuyerCredit,
            };
        },

        methods: {
            convertAnswer(obj, value) {
                return Object.keys(obj)[parseInt(value) - 1];
            },
            numberWithCommas(x) {
                if (x == null) {
                    return 'Not answered.';
                } else {
                    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                }
            },
        },
    };
</script>

<style scoped></style>
