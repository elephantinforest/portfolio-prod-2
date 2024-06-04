<div id="fixedContainer" class="hidden fixed top-0 left-0 w-full z-50 flex flex-col items-start">
    <div id="loading" class=" hidden w-full py-4 ml-4" aria-label="読み込み中">
        <div class="animate-spin h-10 w-10 border-4 border-blue-500 rounded-full border-t-transparent"></div>
    </div>
    <div id="imageContainer" class="">
    </div>
</div>
<div id="resize" class=" mt-auto w-auto h-auto ">
    <input type="hidden" class="animate-ping animate-jump animate-thrice animate-ease-linear animate-normal animate-fill-both animate-shake ">
    <div class="pageButtn hidden w-40 lg:block mt-28 fixed">
        <div id="loading" class="flex justify-center hidden" aria-label="読み込み中">
            <div class="animate-spin h-10 w-10 border-4 border-blue-500 rounded-full border-t-transparent"></div>
        </div>
        <div class="" id="imageContainer"></div>
        <ul id="buttn" class=" mt-5 ">
            <div id="registers-all-contents" class="registers-all-contents">

            </div><!-- コンテンツの埋め込み先をid指定 -->
        </ul>
        <div class="pager bg-white w-40" id="registers-all-pager"></div>
        <div class="drop ui-widget-content fixed bottom-0 left-2 z-50" style="width: 150px; height: 150px;">
            <img id="drop" class="rounded-lg opacity-80" src="<?php echo $this->createPath('/var/www/html/src/imgs/_ec50cd88-36eb-4064-8dda-9fb167401692.jpg') ?>" alt="Your Company">
        </div>
    </div>

    <div id="parlent" class="w-auto h-auto ">
        <!-- <div class="relative"> -->
        <?php if ($locations) : ?>
            <input id="locationSpot" type="hidden" name="location" value="<?php echo $locations['location_id']; ?>">
            <div id="slider" class="">
                <div id="loading" class="flex justify-center hidden" aria-label="読み込み中">
                    <div class="animate-spin h-10 w-10 border-4 border-blue-500 rounded-full border-t-transparent"></div>
                </div>
                <div class="" id="imageContainer"></div>
                <img id="slideImage" src="<?php echo $this->createPath($locations['file_path']); ?>" alt="背景画像" class=" slideImage bg-no-repeat bg-contain bg-center w-full ">

            </div>
            <!-- `<li class="delete text-white bg-yellow-400 via-yellow-500 to-yellow-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-yellow-300 dark:focus:ring-yellow-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 cursor-pointer">
                <input type="hidden" name="label_register" value="${register['register_id']}">
                ${register['name']}
            </li> -->
        <?php else : ?>
            <!-- $locations が空の場合の処理 -->
            <input id="locationSpot" type="hidden" name="location" value="">
            <div id="slider" class="w-full h-screen bg-no-repeat bg-contain bg-center">
                <img id="slideImage" src="" class=" slideImage w-full">
            </div>
        <?php endif; ?>
        <ul id="registersItem" class="registersItem">
            <?php if (isset($registers)) : ?>
                <?php foreach ($registers as $register) : ?>
                    <li  class="registerde hidden z-30 ui-sortable-handle" style="position: absolute; left: <?= $register['left_position'] ?>%; top: <?= $register['top_position'] ?>px;  width: <?= $register['width'] ?>px; height: <?= $register['height'] ?>px ;">

                        <a class="parent" href="/update?id=<?= htmlspecialchars($register['register_id'], ENT_QUOTES, 'UTF-8') ?>" style="width: <?= intval($register['width']) ?>px; height: <?= intval($register['height']) ?>px;">

                            <img id="registerContainer" class="img opacity-85 rounded-lg grayscale hover:contrast-200 hover:grayscale-0  " alt="画像の説明" src="<?= $this->createPath($register['file_path']) ?>" style="width: <?= $register['width'] ?>px; height: <?= $register['height'] ?>px ;">
                            <input type="hidden" name="register_id" value="<?= $register['register_id'] ?>">
                        </a>
                        <input type="hidden" class="window_width" name="window_width" value="<?= $register['window_width'] ?>">
                        <input type="hidden" class="window_height" name="window_height" value="<?= $register['window_height'] ?>">
                    </li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
    </div>
    <!-- </div> -->
</div>
