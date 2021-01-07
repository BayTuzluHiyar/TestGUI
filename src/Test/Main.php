<?php

namespace Test;

use pocketmine\plugin\PluginBase;
use pocketmine\Player;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\item\Item;

use pocketmine\event\Listener;

use muqsit\invmenu\InvMenu;
use muqsit\invmenu\InvMenuHandler;

use pocketmine\inventory\transaction\action\SlotChangeAction;

class Main extends PluginBase implements Listener{
    
    public function onEnable(){
    if(!InvMenuHandler::isRegistered()){
	InvMenuHandler::register($this);
    }
    }
    public function onCommand(CommandSender $p, Command $kmt, string $label, array $args): bool{
    if($kmt->getName() =="test"){
    $menu = InvMenu::create(InvMenu::TYPE_CHEST);
    $menu->readonly();
    $env = $menu->getInventory();
    $env->addItem(Item::get(Item::DIAMOND));
    $menu->setListener(function (Player $p, Item $itemClicked, Item $itemClickedWith, SlotChangeAction $action){
    if($itemClicked->getId() === Item::DIAMOND){
    $env = $p->getInventory();
    $zirhlar = $p->getArmorInventory();
    $env->addItem(Item::get(Item::DIAMOND_SWORD));
    $zirhlar->setHelmet(Item::get(Item::DIAMOND_HELMET));
    $p->removeWindow($action->getInventory());
                }
                });
                $menu->send($p);
    }
    return true;
}
}
