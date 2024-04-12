@props(['style' => session('flash.bannerStyle', 'success'), 'message' => session('flash.banner')])

<div x-data="{{ json_encode(['show' => false, 'style' => $style, 'message' => $message]) }}"
    :class="{
        'bg-green-500': style == 'success',
        'bg-red-700': style == 'danger',
        'bg-gray-500': style != 'success' &&
            style != 'danger'
    }"
    x-transition:enter="transition-transform transition-opacity ease-out duration-300"
    x-transition:enter-start="opacity-0 transform translate-y-5"
    x-transition:enter-end="opacity-100 transform translate-y-0" x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" x-show="show && message"
    x-on:banner-message.window="style = event.detail.style;
                                message = event.detail.message;
                                show = true;
                                setTimeout(() => {
                                    show = false;
                                }, 2000);"
    x-init="setTimeout(() => {
        show = true;
        setTimeout(() => {
            show = false;
        }, 2000);
    }, 100);"
    class="fixed bottom-0 sm:bottom-5 rounded-none max-w-screen-sm inset-x-0 mx-auto z-50 p-2 sm:p-3 sm:rounded-lg"
    style="display: none;">
    <div class="py-0 px-3">
        <div class="flex items-center justify-between flex-wrap ">
            <div class="w-0 flex-1 flex items-center min-w-0">
                <!-- Banner icon -->
                <span class="flex p-2 rounded-lg"
                    :class="{ 'bg-green-600': style == 'success', 'bg-red-600': style == 'danger' }">
                    <svg x-show="style == 'success'" class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <svg x-show="style == 'danger'" class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                    </svg>
                    <svg x-show="style != 'success' && style != 'danger'" class="h-5 w-5 text-white"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                    </svg>
                </span>

                <!-- Message -->
                <p class="ms-3 font-medium text-sm text-white" x-text="message"></p>
            </div>

            <!-- Remove banner -->
            <div class="shrink-0 sm:ms-3">
                <button type="button" class="-me-1 flex p-2 rounded-md focus:outline-none sm:-me-2 transition"
                    :class="{
                        'hover:bg-green-600 focus:bg-green-600': style ==
                            'success',
                        'hover:bg-red-600 focus:bg-red-600': style == 'danger'
                    }"
                    aria-label="Dismiss" x-on:click="show = false">
                    <i class="icon-x text-sm text-white"></i>
                </button>
            </div>
        </div>
    </div>
</div>
