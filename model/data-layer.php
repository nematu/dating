<?php
/** Data-layer for Dating site
 * Functions to collect data
 *
 * Nematullah Ayaz
 * 02/25/2021
 */

/** Function to get to return Gender selection */
function getGenders()
{
    return array('Male', 'Female','Others');
}

/** Function to get to return States  */
function getStates()
{
    return array('Alabama','Alaska', 'Arizona', 'Arkansas', 'California', 'Colorado',
        'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii', 'Idaho', 'Illinois', 'Indiana',
        'Iowa', 'Kansas', 'Kentucky', 'Louisiana', 'Maine', 'Maryland', 'Massachusetts',
        'Michigan', 'Minnesota', 'Mississippi', 'Missouri', 'Montana, Nebraska', 'Nevada',
        'New Hampshire', 'New Jersey', 'New Mexico', 'New York', 'North Carolina',
        'North Dakota', 'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island',
        'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont', 'Virginia',
        'Washington', 'West Virginia', 'Wisconsin', 'Wyoming');
}

/** Function to get to return Indoor Interests */
function getIndoor()
{
    return array('Tv', 'Movies', 'Cooking', 'Board Games', 'Puzzles', 'Reading', 'Playing cards', 'Video games');
}


/** Function to get to return Outdoor Interests */
function getOutdoor()
{
    return array('Hiking', 'Biking', 'Swimming', 'Collecting', 'Walking', 'Climbing');
}