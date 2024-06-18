<template>
    <div class="relative rounded-lg">
        <div
            class="rounded-xl bg-black/90 backdrop-blur-sm m-2"
            :class="[
                show && width > 639
                    ? 'absolute z-30 transition ease-in-out delay-150 hover:-translate-y-1 hover:bg-[#202020] duration-300'
                    : '',
            ]"
        >
            <div
                @mouseover="show = true"
                @mouseleave="
                    show = false;
                    showVideo = false;
                "
                class="relative rounded-t-lg overflow-hidden cursor-pointer"
            >
                <img
                    class="cursor-pointer object-cover rounded-t-lg w-full h-full"
                    :src="thumbnail || ''"
                    :class="
                        (show
                            ? 'transition ease-in-out delay-150 rounded-t-lg cursor-pointer object-cover w-full h-full'
                            : 'rounded-lg',
                        showVideo ? 'delay-350 hidden' : '')
                    "
                />
                <div
                    class="w-full h-full aspect-video cursor-pointer"
                    :class="showVideo ? '' : 'delay-350 hidden'"
                >
                    <video ref="video" :src="videoUrl || ''" type="video/mp4" />
                </div>
            </div>
            <div>
                <div class="flex mt-1.5 p-2">
                    <div>
                        <div class="w-full h-full leading-7">
                            <!-- <span
                                v-if="user.split(' ').length > 1"
                                class="flex justify-center content-center text-center bg-white rounded-full w-8 h-8"
                            >
                                {{
                                    user.split(" ")[0][0] +
                                    user.split(" ")[1][0]
                                }}</span
                            >
                            <span
                                v-else
                                class="flex justify-center content-center text-center bg-white rounded-full w-8 h-8"
                            >
                                {{ user.slice(0, 2).toUpperCase() }}</span
                            > -->
                            <img
                                class="rounded-full m-1.5 mt-2 flex items-baseline w-8 h-8"
                                :src="image || ''"
                            />
                        </div>
                    </div>
                    <div class="px-1.5 text-white mt-1">
                        <div
                            class="text-[17px] font-extrabold w-full cursor-pointer"
                        >
                            {{ title.substring(0, 100) }}
                        </div>
                        <p
                            class="text-[14px] text-gray-300 font-extrabold flex gap-1 items-center cursor-pointer"
                        >
                            {{ user.substring(0, 30) }}
                        </p>
                        <div
                            class="flex gap-1 text-sm mb-1 text-gray-300 cursor-pointer"
                        >
                            <p>{{ views }} visualizaciones</p>
                            <p>•</p>
                            <p>{{ time }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { defineProps, toRefs, ref, watch, onMounted } from "vue";

const props = defineProps({
    title: String,
    user: String,
    views: String,
    time: String,
    image: String,
    videoUrl: String,
    thumbnail: String,
});

const { title, user, views, image, time, videoUrl, thumbnail } = toRefs(props);

let show = ref(false);
let showVideo = ref(false);
let video = ref(null);
let width = ref(document.documentElement.clientWidth);

onMounted(() => {
    window.addEventListener("resize", () => {
        width.value = document.documentElement.clientWidth;
    });
});

watch(
    () => show.value,
    (show) => {
        if (show) {
            showVideo.value = true;
            video.value.play();
            return "";
        }

        showVideo.value = false;
        video.value.pause();
        video.value.currentTime = 0;
    }
);
</script>

<style lang="scss" scoped></style>
