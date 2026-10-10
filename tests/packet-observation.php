<?php

declare(strict_types=1);

use NhanAZ\FormDebug\Main;
use pocketmine\event\server\DataPacketReceiveEvent;
use pocketmine\event\server\DataPacketSendEvent;
use pocketmine\network\mcpe\NetworkSession;
use pocketmine\network\mcpe\protocol\ModalFormRequestPacket;
use pocketmine\network\mcpe\protocol\ModalFormResponsePacket;

$source = $argv[1] ?? null;
if ($source === null || !is_file($source . '/vendor/autoload.php')) {
	fwrite(STDERR, "Usage: php tests/packet-observation.php /path/to/Axolotl-PM-source\n");
	exit(2);
}
require $source . '/vendor/autoload.php';
require $argv[2] ?? dirname(__DIR__) . '/src/NhanAZ/FormDebug/Main.php';

$plugin = (new ReflectionClass(Main::class))->newInstanceWithoutConstructor();
$session = (new ReflectionClass(NetworkSession::class))->newInstanceWithoutConstructor();
$response = (new ReflectionClass(ModalFormResponsePacket::class))->newInstanceWithoutConstructor();
$request = (new ReflectionClass(ModalFormRequestPacket::class))->newInstanceWithoutConstructor();

ob_start();
$plugin->onDataPacketReceive(new DataPacketReceiveEvent($session, $response));
$receiveOutput = ob_get_clean();
ob_start();
$plugin->onDataPacketSend(new DataPacketSendEvent([$session], [$request]));
$sendOutput = ob_get_clean();
if (!is_string($receiveOutput) || !str_contains($receiveOutput, '<unattached session>')
	|| !is_string($sendOutput) || !str_contains($sendOutput, '<unattached session>')) {
	throw new RuntimeException('Form packet observation lost an unattached session');
}

echo "PASS: form packets tolerate unattached sessions\n";
