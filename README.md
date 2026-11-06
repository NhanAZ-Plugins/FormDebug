# FormDebug

Inspect Axolotl-PM modal form packets on development servers

[![CI](https://github.com/NhanAZ-Plugins/FormDebug/actions/workflows/build.yml/badge.svg)](https://github.com/NhanAZ-Plugins/FormDebug/actions/workflows/build.yml)
[![Latest release](https://img.shields.io/github/v/release/NhanAZ-Plugins/FormDebug)](https://github.com/NhanAZ-Plugins/FormDebug/releases/latest)
[![License](https://img.shields.io/github/license/NhanAZ-Plugins/FormDebug)](https://github.com/NhanAZ-Plugins/FormDebug/blob/master/LICENSE)
[![Discord](https://img.shields.io/discord/986553214889517088?label=Discord&logo=discord&logoColor=white&color=5865F2)](https://discord.gg/j2X83ujT6c)


## Requirements

- Axolotl-PM API 5.0.0. The [build workflow](.github/workflows/build.yml) records pinned server revisions and test results. Compatibility with every 5.x revision has not been verified.
- PHP 8.1 or newer, as required by Axolotl-PM 5.

## Installation and use

Download the PHAR from [GitHub Releases](https://github.com/NhanAZ-Plugins/FormDebug/releases), place it in the server's `plugins` directory and restart the server. FormDebug has no commands or configuration file. Send or answer a modal form to see the packet dump in the server console output.

Packet dumps can contain player-entered form responses and other private data. Use the plugin only on a development server with controlled access to console output and log files. Remove it when debugging is finished.

## Development and validation

The [build workflow](.github/workflows/build.yml) tests incoming and outgoing packet handling for unattached network sessions against pinned Axolotl-PM source revisions. It then uses [DevTools](https://github.com/AxolotlBucketLabs/DevTools) to run PHPStan at maximum level, build the PHAR and inspect the artifact. Exact tested revisions are recorded in the workflow and its [GitHub Actions runs](https://github.com/NhanAZ-Plugins/FormDebug/actions).

The tests check the packet event callbacks. A live Bedrock client form exchange has not been verified.

## Support

Join [NhanAZ Discord](https://discord.gg/j2X83ujT6c) for support.

## License

FormDebug is distributed under the [GNU General Public License version 3](LICENSE).
