<script setup>
import { ref, onMounted } from "vue";
import { usePage, Link } from "@inertiajs/vue3";
import SideNavItem from "../Components/SideNavItem.vue";
import MenuIcon from "vue-material-design-icons/Menu.vue";
import MagnifyIcon from "vue-material-design-icons/Magnify.vue";

let openSideNav = ref(true);
let openSideNavOverlay = ref(false);
let sideNavOverlay = ref(null);
let width = ref(document.documentElement.clientWidth);

onMounted(() => {
    resize();
    sideNavOverlay.value.classList.value =
        sideNavOverlay.value.classList.value += " hidden";
    window.addEventListener("resize", () => {
        width.value = document.documentElement.clientWidth;
        resize();
    });
});

const resize = () => {
    if (width.value < 1280 && openSideNav.value) {
        openSideNav.value = false;
    }
    if (width.value > 1279 && !openSideNav.value) {
        openSideNav.value = true;
    }
};

const isNavOverlay = () => {
    if (usePage().url === "/") openSideNav.value = !openSideNav.value;
    if (usePage().url === "/add-video")
        openSideNavOverlay.value = !openSideNavOverlay.value;
    if (usePage().url === "/delete-video")
        openSideNavOverlay.value = !openSideNavOverlay.value;
    if (width.value < 640) openSideNavOverlay.value = !openSideNavOverlay.value;
    if (usePage().url !== "/" && width.value < 640)
        openSideNavOverlay.value = !openSideNavOverlay.value;
    if (usePage().props.video)
        openSideNavOverlay.value = !openSideNavOverlay.value;
};
</script>

<template>
    <div class="relative">
        <div
            id="TopNav"
            class="w-[100%] h-[60px] fixed bg-black z-20 flex items-center justify-between"
        >
            <div class="flex items-center">
                <button
                    @click="isNavOverlay()"
                    class="p-2 ml-3 rounded-full hover:bg-gray-800 inline-block cursor-pointer"
                >
                    <MenuIcon fillColor="#FFFFFF" :size="26" />
                </button>
                <div class="mx-2"></div>
                <Link
                    :href="route('home')"
                    class="flex items-center justify-center mr-10 cursor-pointer text-3xl mt-3 mx-4"
                    href="#"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="w-8 h-8 text-white"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="m15.75 10.5 4.72-4.72a.75.75 0 0 1 1.28.53v11.38a.75.75 0 0 1-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25h-9A2.25 2.25 0 0 0 2.25 7.5v9a2.25 2.25 0 0 0 2.25 2.25Z"
                        />
                    </svg>
                    <h1 class="mx-1 flex justify-center text-white">
                        Com<span class="font-bold">Tube</span>
                    </h1>
                </Link>
            </div>

            <div class="w-[600px] md:block hidden">
                <div class="rounded-full flex items-center bg-[#222222]">
                    <input
                        type="text"
                        class="form-control block w-full px-5 py-1.5 text-base font-normal text-gray-200 bg-black placeholder-gray-400 bg-clip-padding border border-solid border-l-gray-700 border-y-gray-700 rounded-l-full transition ease-in-out m-0 border-transparent focus:ring-0"
                        placeholder="Search"
                    />
                    <MagnifyIcon class="mx-6" fillColor="#FFFFFF" :size="23" />
                </div>
            </div>
            <div>
                <div
                    class="flex justify-center content-center w-full h-full gap-4 px-4"
                >
                    <button
                        type="button"
                        class="relative rounded-full p-2 text-gray-200 bg-white/5 hover:bg-white/10 hover:text-gray-100 focus:outline-none"
                    >
                        <svg
                            class="h-8 w-8"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            aria-hidden="true"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"
                            />
                        </svg>
                    </button>
                    <button
                        type="button"
                        class="relative rounded-full px-3 text-gray-200 bg-white/5 hover:bg-white/10 hover:text-gray-100 focus:outline-none"
                    >
                        MC
                    </button>
                </div>
                <!-- Settings Dropdown -->
            </div>
        </div>

        <div v-if="width > 639">
            <div
                v-if="$page.url === '/'"
                id="SideNav"
                :class="[!openSideNav ? 'w-[70px]' : 'w-[240px]']"
                class="h-[100%] fixed z-0 bg-black"
            >
                <ul
                    :class="[!openSideNav ? 'p-2' : 'px-5 pb-2 pt-[7px]']"
                    class="mt-[60px] w-full"
                >
                    <Link :href="route('home')">
                        <SideNavItem
                            :openSideNav="openSideNav"
                            iconString="Home"
                        />
                    </Link>
                    <Link :href="route('addVideo')">
                        <SideNavItem
                            :openSideNav="openSideNav"
                            iconString="Add Video"
                        />
                    </Link>
                    <Link :href="route('deleteVideo')">
                        <SideNavItem
                            :openSideNav="openSideNav"
                            iconString="Delete Video"
                        />
                    </Link>
                    <div class="border-b border-b-gray-700 my-2.5"></div>
                    <SideNavItem
                        :openSideNav="openSideNav"
                        iconString="Subscriptions"
                    />
                    <SideNavItem
                        :openSideNav="openSideNav"
                        iconString="Library"
                    />
                    <SideNavItem
                        :openSideNav="openSideNav"
                        iconString="Liked"
                    />
                    <SideNavItem
                        :openSideNav="openSideNav"
                        iconString="History"
                    />
                    <SideNavItem
                        :openSideNav="openSideNav"
                        iconString="Watch Later"
                    />
                    <div v-if="openSideNav">
                        <div class="border-b border-b-gray-700 my-2.5"></div>
                    </div>
                </ul>
            </div>
        </div>

        <!-- OVERLAY NAV SECTION -->
        <div
            @click="openSideNavOverlay = false"
            class="bg-black bg-opacity-70 fixed z-50 w-full h-screen"
            :class="
                openSideNavOverlay
                    ? 'animate__animated animate__fadeIn animate__faster'
                    : 'hidden z-[-1]'
            "
        />
        <div
            id="SideNavOverlay"
            ref="sideNavOverlay"
            class="h-[100%] fixed z-50 bg-black mt-[9px] w-[240px]"
            :class="
                openSideNavOverlay
                    ? 'animate__animated animate__slideInLeft animate__faster'
                    : 'animate__animated animate__slideOutLeft animate__faster'
            "
        >
            <div class="flex items-center">
                <button
                    @click="isNavOverlay()"
                    class="p-2 ml-3 rounded-full hover:bg-gray-800 cursor-pointer"
                >
                    <MenuIcon fillColor="#FFFFFF" :size="26" />
                </button>
                <div class="mx-2"></div>
                <Link
                    :href="route('home')"
                    class="flex items-center justify-center mr-10 cursor-pointer text-3xl mt-3 mx-4"
                    href="#"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="w-8 h-8 text-white"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="m15.75 10.5 4.72-4.72a.75.75 0 0 1 1.28.53v11.38a.75.75 0 0 1-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25h-9A2.25 2.25 0 0 0 2.25 7.5v9a2.25 2.25 0 0 0 2.25 2.25Z"
                        />
                    </svg>
                    <h1 class="mx-1 flex justify-center text-white">
                        Com<span class="font-bold">Tube</span>
                    </h1>
                </Link>
            </div>
            <ul class="w-full px-5 py-2 p-2 mt-2">
                <Link :href="route('home')">
                    <SideNavItem :openSideNav="true" iconString="Home" />
                </Link>
                <Link :href="route('addVideo')">
                    <SideNavItem :openSideNav="true" iconString="Add Video" />
                </Link>
                <Link :href="route('deleteVideo')">
                    <SideNavItem
                        :openSideNav="true"
                        iconString="Delete Video"
                    />
                </Link>
                <div class="border-b border-b-gray-700 my-2.5"></div>
                <SideNavItem :openSideNav="true" iconString="Subscriptions" />
                <SideNavItem :openSideNav="true" iconString="Library" />
                <SideNavItem :openSideNav="true" iconString="Liked" />
                <SideNavItem :openSideNav="true" iconString="History" />
                <SideNavItem :openSideNav="true" iconString="Watch Later" />
                <div v-if="true">
                    <div class="border-b border-b-gray-700 my-2.5"></div>
                    <div class="text-gray-400 text-[14px] text-extrabold">
                        About Press Copyright
                        <div>Contact us</div>
                        Creator Advertise Developers
                    </div>
                    <div class="border-b border-b-gray-700 my-2.5"></div>
                    <div class="text-gray-400 text-[14px] text-extrabold">
                        Terms Privacy Policy & Safety
                        <div>How YouTube works</div>
                        <span>Test new features</span>
                    </div>
                </div>
            </ul>
        </div>
        <!-- OVERLAY NAV SECTION END -->

        <div
            class="w-[100%] h-[calc(100vh-60px)] absolute right-0 top-[60px]"
            :class="{
                'w-[calc(100%-70px)]': !openSideNav,
                'w-[calc(100%-240px)]': openSideNav,
                'w-[100vw] xl:w-[calc(100%-80px)]': $page.url !== '/',
                'w-[100vw]': width < 639,
            }"
        >
            <slot />
        </div>
    </div>
</template>

<style>
body {
    background-color: black;
}
</style>
