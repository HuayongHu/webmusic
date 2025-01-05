#雨欣音乐播放器

这是一个基于 PHP 和原生 HTML/CSS/JavaScript 的网页端音乐播放器，支持本地音乐文件的随机播放、单曲循环、播放列表展示等功能。界面简洁美观，使用方便。

##项目功能

- 支持随机播放本地音乐文件。
- 支持单曲循环播放模式。
- 提供可视化播放列表，点击即可切换播放。
- 音乐文件大小显示。
- 自适应界面设计，兼容桌面端和移动端浏览器。

##技术栈

- **PHP**：负责后端逻辑，包括音乐文件的读取、随机选择和数据传递。
- **HTML5**：负责页面结构，包含 `audio` 标签实现音频播放。
- **CSS3**：用于实现响应式布局和播放器的美观设计。
- **JavaScript**：实现播放器交互逻辑（播放、暂停、切歌、模式切换等）。

##实现方法

1. **后端逻辑**：通过 PHP 的 `glob` 函数读取根目录下的 `.mp3` 文件，随机选取一首作为默认播放音乐，并返回音乐列表及文件大小信息。
2. **前端界面**：
   - 播放器分为左侧播放区域和右侧音乐列表。
   - 使用 CSS 实现渐变背景、毛玻璃效果和响应式布局。
3. **交互功能**：
   - 使用 JavaScript 操作 `audio` 标签，实现播放控制、单曲循环、随机模式切换等功能。
   - 根据播放的歌曲动态更新当前歌曲信息及播放列表选中状态。

#部署方法

按照以下步骤在本地或服务器环境中部署该项目：

'''环境要求

- Web 服务器（如 Apache 或 Nginx）。
- PHP 7.0 或更高版本。
- 一个包含 `.mp3` 文件的根目录。

'''部署步骤

1. **克隆项目代码**：
   [代码示例]
   ¤¤¤bash
   git clone https://github.com/你的用户名/雨欣音乐播放器.git
   cd 雨欣音乐播放器
   '''

2. **添加音乐文件**：
   将你的 `.mp3` 音乐文件放置到项目根目录中。

3. **运行项目**：
   - 如果使用 PHP 内置服务器，可以在项目根目录运行以下命令：
     [代码示例]
     '''bash
     php -S localhost:8000
     '''
     然后在浏览器中访问 `http://localhost:8000`。
   - 如果使用 Apache/Nginx，确保配置了项目目录为网站根目录，并开启 PHP 支持。

4. **访问播放器**：
   在浏览器中访问你的部署地址即可使用音乐播放器。

## 截图预览

（可添加播放器界面的截图）

## 项目地址

GitHub 项目链接：[雨欣音乐播放器](https://github.com/你的用户名/雨欣音乐播放器)

---

欢迎提 issue 或提交 PR 以改进此项目！

