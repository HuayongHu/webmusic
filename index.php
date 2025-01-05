<?php
// 获取根目录下的所有音乐文件
$musicFiles = glob('*.mp3');
$randomMusic = $musicFiles[array_rand($musicFiles)]; // 随机选择一首音乐

// 获取文件大小的函数
function getFileSize($file) {
    $size = filesize($file); // 获取文件大小（字节）
    if ($size < 1024) {
        return $size . ' B';
    } elseif ($size < 1048576) {
        return round($size / 1024, 2) . ' KB';
    } else {
        return round($size / 1048576, 2) . ' MB';
    }
}

// 获取所有音乐文件的大小
$musicData = [];
foreach ($musicFiles as $file) {
    $musicData[$file] = [
        'name' => pathinfo($file, PATHINFO_FILENAME), // 去掉 .mp3 后缀
        'size' => getFileSize($file),
    ];
}
?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="user-scalable=no">
    <title>雨欣音乐播放器</title>
    <style>
        /* 通用样式 */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(135deg, #1db954, #191414);
            color: white;
            overflow: hidden;
        }

        #music-player {
            display: flex;
            flex-direction: row;
            width: 90%;
            height: 80%;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.4);
        }

        /* 播放器左侧 */
        #player-controls {
            flex: 2;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            padding: 20px;
            position: relative;
        }

        #current-song-info {
            width: 100%;
            text-align: center;
            margin-bottom: 20px;
            background-color: rgba(255, 255, 255, 0.1);
            padding: 10px;
            border-radius: 10px;
        }

        #current-song-info h2 {
            font-size: 20px;
            margin-bottom: 5px;
        }

        #current-song-info p {
            font-size: 14px;
            color: #bbb;
        }

        #player-controls audio {
            width: 100%;
            margin-bottom: 20px;
        }

        #player-buttons {
            display: flex;
            gap: 15px;
        }

        #player-buttons button {
            padding: 10px 20px;
            background-color: #1db954;
            color: white;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        #player-buttons button:hover {
            background-color: #14833b;
        }

        /* 音乐列表右侧 */
        #music-list {
            flex: 1;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            overflow-y: auto;
            border-left: 1px solid rgba(255, 255, 255, 0.2);
        }

        #music-list h3 {
            text-align: center;
            padding: 15px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        #music-list ul {
            list-style: none;
            padding: 10px;
        }

        #music-list li {
            padding: 10px;
            cursor: pointer;
            transition: background 0.3s;
        }

        #music-list li:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        #music-list li.active {
            background-color: rgba(29, 185, 84, 0.6);
        }
    </style>
</head>
<body>
    <div id="music-player">
        <!-- 播放器控制区域 -->
        <div id="player-controls">
            <!-- 当前歌曲信息 -->
            <div id="current-song-info">
                <h2 id="song-name"><?php echo pathinfo($randomMusic, PATHINFO_FILENAME); ?></h2>
                <p id="song-size"><?php echo $musicData[$randomMusic]['size']; ?></p>
            </div>
            <audio id="audio-player" controls>
                <source src="<?php echo $randomMusic; ?>" type="audio/mp3">
                您的浏览器不支持音频元素。
            </audio>
            <div id="player-buttons">
                <button onclick="playMusic()">播放</button>
                <button onclick="pauseMusic()">暂停</button>
                <button onclick="loopMusic()">单曲循环</button>
                <button onclick="toggleRandom()">随机播放</button>
            </div>
        </div>

        <!-- 音乐列表 -->
        <div id="music-list">
            <h3>播放列表</h3>
            <ul>
                <?php foreach ($musicFiles as $file): ?>
                    <li onclick="selectMusic('<?php echo $file; ?>')" 
                        class="<?php echo $file === $randomMusic ? 'active' : ''; ?>">
                        <?php echo pathinfo($file, PATHINFO_FILENAME); ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

    <script>
        var audioPlayer = document.getElementById('audio-player');
        var currentMusic = '<?php echo $randomMusic; ?>';
        var musicData = <?php echo json_encode($musicData); ?>;
        var randomMode = false; // 随机播放模式

        // 显示当前歌曲信息
        function updateSongInfo(file) {
            document.getElementById('song-name').innerText = musicData[file].name;
            document.getElementById('song-size').innerText = musicData[file].size;
        }

        // 选择音乐
        function selectMusic(file) {
            currentMusic = file;
            audioPlayer.src = file;
            audioPlayer.load();
            playMusic();
            updateActiveItem(file);
            updateSongInfo(file);
        }

        // 播放音乐
        function playMusic() {
            audioPlayer.play();
        }

        // 暂停音乐
        function pauseMusic() {
            audioPlayer.pause();
        }

        // 单曲循环
        function loopMusic() {
            audioPlayer.loop = !audioPlayer.loop;
            alert(audioPlayer.loop ? '单曲循环已开启' : '单曲循环已关闭');
        }

        // 随机播放模式切换
        function toggleRandom() {
            randomMode = !randomMode;
            alert(randomMode ? '随机播放模式已开启' : '随机播放模式已关闭');
        }

        // 更新列表中的当前选中项
        function updateActiveItem(file) {
            var musicListItems = document.querySelectorAll('#music-list li');
            musicListItems.forEach(item => {
                item.classList.remove('active');
                if (item.innerText === musicData[file].name) {
                    item.classList.add('active');
                }
            });
        }

        // 随机选择下一首音乐
        function playRandomMusic() {
            var musicFiles = Object.keys(musicData);
            var randomIndex = Math.floor(Math.random() * musicFiles.length);
            var randomMusic = musicFiles[randomIndex];
            selectMusic(randomMusic);
        }

        // 播放结束事件
        audioPlayer.addEventListener('ended', function () {
            if (randomMode) {
                playRandomMusic(); // 如果随机播放开启，则随机选一首音乐播放
            }
        });

        // 页面加载时自动播放随机音乐
        window.onload = function () {
            audioPlayer.play();
        };
    </script>
</body>
</html>
