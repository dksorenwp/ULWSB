# Ultra Lightweight Streaming Box (ULWSB)

ULWSB is a web control panel build most in PHP, that allows users to transform their single-board computer into a streaming device. With ULWSB the general idea is that users can send HDMI from USB capture card to SRT or RTMP servers, and control all from the webui.



## Future Features:

- [ ] Admin forgot password
- [ ] Auto backup config
- [ ] Auto update live
- [ ] Auto update dev
- [ ] Setup installer
- [ ] Setup uninstaller
- [ ] Site language
- [ ] LTE modems
- [ ] Wi-Fi settings
- [ ] Stream settings
- [ ] JSON overlays
- [ ] JSON read info
- [ ] Watermarks
- [ ] Auto text overlays on low bit
- [ ] Auto start stream on boot
- [ ] Webhook/webSocket trigger by statement
- [ ] Webhook/webSocket trigger by button
- [ ] Cron jobs
- [ ] Log system, Notifications pushover
- [ ] Blacklist IP if to many fail login

## Implemented Features:
- [X] Login with encrypted password
- [X] Log with action, warning and error log local and notifications on discord as simple / embeds chat


## Requirements:

Before using ULWSB, ensure you have the following software and versions installed:

- Nginx 1.22.1+
- ffmpeg
- screen
- php-fpm 8.1+
- php-curl





**Installation**: Easy, just run this command from your terminal:

```shell
curl -sSL https://raw.githubusercontent.com/dksorenwp/ULWSB/main/setup.sh | bash
```




## Getting Started:

To get started with ULWSB on your single-board computer, follow these steps:

1. **Installation**: Use the setup installer to install ULWSB on your server.

2. **Configuration**: Configure ULWSB according to your requirements, including setting up admin accounts, stream settings, and more.

3. **Usage**: Start using ULWSB to control your ULWSB streaming device and manage your video streams.


## License:

ULWSB is licensed under the [MIT License](LICENSE). Feel free to use, modify, and distribute this software according to the terms of the license.

## Support:

For any issues, questions or ideas please [open an issue](https://github.com/dksorenwp/ulwsb/issues) on our GitHub repository.

---

Happy streaming with ULWSB!
