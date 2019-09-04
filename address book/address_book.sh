#!/bin/bash

clear
choice="y"
db="address.txt"
rm -r $db

printHeader() {
    printf "%-25s%-15s%-5s\n\n" "Player Name", "Team Name", "Avg" | tr ',' ' '
}

while [ $choice = "y" ]
do
    printf "========================================\n"
    printf "******************MENU******************\n\n"
    printf "%-40s\n" "0. Scrape Data from Web"
    printf "%-40s\n" "1. View Complete Address Book"
    printf "%-40s\n" "2. View Specific Player or Team "
    printf "%-40s\n" "3. Add Player "
    printf "%-40s\n" "4. Delete Player "
    printf "%-40s\n" "5. Exit "
    printf "\n========================================\n"
    printf "%s" "Enter your choice: "
    read ch
    printf "\n"

    case $ch in
        0)  printf "**************SCRAPE DATA***************\n\n"
            read -p "Enter Team Name (Keep blank for India): " team_name
            team_name="${team_name// /_}"
            team_name="$(sed -e 's/\(.*\)/\L\1/' <<< $team_name)"
            case $team_name in
                england ) team=1;;
                australia ) team=2;;
                south_america ) team=3;;
                west_indies ) team=4;;
                new_zealand ) team=5;;
                pakistan ) team=7;;
                sri_lanka ) team=8;;
                * ) team_name="india"; team=6;;
            esac
            wget -q -O- "http://stats.espncricinfo.com/ci/engine/records/averages/batting.html?class=2;current=2;id=$team;type=team"  > data.txt
            cat data.txt | grep -i -e '</\?TD\|</\?TR\|</\?TH' | sed 's/^[\ \t]*//g' | tr -d '\n' | sed 's/<\/TR[^>]*>/\n/Ig'  | sed 's/<\/\?TABLE∥TR∥A∥THTABLE\|TR\|\|THTABLE∥TR∥A∥TH[^>]*>//Ig' | sed 's/^<T[DH][^>]*>\|<\/\?T[DH][^>]*>$//Ig' | sed 's/<\/T[DH][^>]*><T[DH][^>]*>/ /Ig' | sed -e 's/<[^>]*>//g' | sed '/^$/d' > data.txt
            sed -i '1d' data.txt
            touch $db
            while IFS= read -r line
            do
                player_name=$(echo $line | cut -d " " -f 1-2)
                avg=$(echo $line | cut -d " " -f 9)
                printf "%-25s%-15s%5s\n" "$player_name", "$team_name", "$avg" | tr ',' ' ' >> $db
            done < "data.txt"
            printf "\n******************DATA******************\n"
            printHeader
            grep -i "$team_name" $db;;
        1)  printf "**************ADDRESS DATA**************\n\n"
            printHeader
            cat $db;;
        2)  printf "**************SEARCH DATA***************\n\n"
            printf "Search by:\n1. Player\n2. Team\n"
            read -p "Enter your choice: " search_op
            case $search_op in
                1)  read -p "Enter Player: " player
                    printHeader
                    grep -i "$player" $db
                    if grep -iq "$player" $db
                    then
                        printf "************FIND SUCCESSFUL*************\n\n"
                        read -p "Want to DELETE player(y/n): " del_op
                        if [ $del_op == "y" ]
                        then
                            sed -i "/$player/Id" $db
                            printf "************DELETE SUCCESSFUL***********\n\n"
                        fi
                    else
                        printf "***********FIND UNSUCCESSFUL************\n\n"
                    fi;;
                2)  read -p "Enter Team Name: " team_name
                    team_name="${team_name// /_}"
                    team_name="$(sed -e 's/\(.*\)/\L\1/' <<< $team_name)"
                    printHeader
                    grep -i "$team_name" $db
                    if grep -iq "$team_name" $db
                    then
                        printf "************FIND SUCCESSFUL*************\n\n"
                        read -p "Want to DELETE player(y/n): " del_op
                        if [ $del_op == "y" ]
                        then
                            sed -i "/\b\($player\)\b/Id" $db
                            printf "************DELETE SUCCESSFUL***********\n\n"
                        fi
                    else
                        printf "***********FIND UNSUCCESSFUL************\n\n"
                    fi;;
                *)  printf "***********INCORRECT CHOICE*************\n\n"
                    exit;;
            esac;;
        3)  printf "**************ADD PLAYER****************\n\n"
            read -p "Enter Player Name: " player_name
            if grep -iq "$player_name" $db
            then
                printHeader
                grep -i "$player_name" $db
                printf "\nPlayer already exists!\nOptions:\n1. Update existing player\n2. Create new player\n"
                read -p "Enter choice: " new_op
                case $new_op in
                    1)  printf "*************UPDATE PLAYER**************\n\n"
                        read -p "Enter Player Name (Press Enter for current): " new_player_name
                        if [ -z "$new_player_name" ]
                        then
                            new_player_name=$player_name
                        fi
                        read -p "Enter Team Name: " new_team_name
                        new_team_name="${new_team_name// /_}"
                        new_team_name="$(sed -e 's/\(.*\)/\L\1/' <<< $new_team_name)"
                        read -p "Enter Batting Average: " new_avg
                        sed -i "/$player_name/Id" $db
                        printf "%-25s%-15s%5s\n" "$new_player_name", "$new_team_name", "$new_avg" | tr ',' ' ' >> $db
                        printf "**********UPDATE SUCCESSFUL*************\n\n";;
                    2)  printf "**********CREATE NEW PLAYER*************\n\n"
                        read -p "Enter Team Name: " new_team_name
                        new_team_name="${new_team_name// /_}"
                        new_team_name="$(sed -e 's/\(.*\)/\L\1/' <<< $new_team_name)"
                        read -p "Enter Batting Average: " new_avg
                        printf "%-25s%-15s%5s\n" "$player_name", "$new_team_name", "$new_avg" | tr ',' ' ' >> $db
                        printf "**********CREATE SUCCESSFUL*************\n\n";;
                    *)  printf "***********INCORRECT CHOICE*************\n\n"
                        exit;;
                esac
            else
                printf "**********CREATE NEW PLAYER*************\n\n"
                read -p "Enter Team Name: " new_team_name
                    new_team_name="${new_team_name// /_}"
                    new_team_name="$(sed -e 's/\(.*\)/\L\1/' <<< $new_team_name)"
                read -p "Enter Batting Average: " new_avg
                printf "%-25s%-15s%5s\n" "$player_name", "$new_team_name", "$new_avg" | tr ',' ' ' >> $db
            fi;;
        4)  printf "*************DELETE PLAYER**************\n\n"
            read -p "Enter Player Name: " player_name
            if grep -iq "$player_name" $db
            then
                printf "Delete following enteries:\n"
                printHeader
                grep -i "$player_name" $db
                sed -i "/$player_name/Id" $db
                printf "**********DELETE SUCCESSFUL*************\n\n"
            else
                printf "**************NOT FOUND*****************\n\n"
            fi;;
        5)  printf "**************THANK YOU*****************\n\n"
            exit;;
        *)  printf "***********INCORRECT CHOICE*************\n\n"
            exit;;
    esac
    printf "\n"
    read -p "Want to continue(y/n): " choice
done