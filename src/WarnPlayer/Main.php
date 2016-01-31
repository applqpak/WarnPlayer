<?php

  namespace WarnPlayer;

  use pocketmine\plugin\PluginBase;
  use pocketmine\event\Listener;
  use pocketmine\utils\TextFormat as TF;
  use pocketmine\command\Command;
  use pocketmine\command\CommandSender;

  class Main extends PluginBase implements Listener {

    public function onEnable() {

      $this->getServer()->getPluginManager()->registerEvents($this, $this);

    }

    public function onCommand(CommandSender $sender, Command $cmd, $label, array $args) {

      if(strtolower($cmd->getName()) === "warn") {

        if(!(isset($args[0]) and isset($args[1]))) {

          $sender->sendMessage(TF::RED . "Error: not enough args. Usage: /warn <player> < reason >");

          return true;

        } else {

          $name = $args[0];

          $player = $this->getServer()->getPlayer($name);

          $sender_name = $sender->getName();

          $sender_display_name = $sender->getDisplayName();

          unset($args[0]);

          $reason = implode(" ", $args);

          if(!($player->isOnline())) {

            $sender->sendMessage(TF::RED . "Player " . $name . " could not be found.");

            return true;

          } else {

            $player->sendMessage(TF::RED . "You have been warned by " . $sender_name . " for " . $reason);

            $sender->sendMessage(TF::GREEN . "You have warned " . $name . " for " . $reason);

            $this->getServer()->broadcastMessage(TF::YELLOW . $name . " has been warned by " . $sender_name . " for " . $reason);

            return true;

          }

        }

      }

    }

  }

?>
