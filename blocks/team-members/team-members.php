<?php


$id = !empty( $block['anchor'] ) ? $block['anchor'] : '';

$classes = isset( $block['className'] ) ? ' ' . $block['className'] : ''; 
$classes .= get_field( 'section_vertical_padding' ) ? ' ' . get_field( 'section_vertical_padding' ) : ' container-y-pad';
$color = ' background-color:' . get_field( 'background_color' ) . ';';


echo '<section ' . ( isset( $id ) ? 'id="' . $id . '" ' : '') . 'style="position: relative;' . ( isset( $color ) ? $color : '' ) . '" class="block-section team-members' . $classes . '">';
    echo is_admin() ? '<div class="admin-block-label">Team Members</div>' : '';    

    echo '<div class="block-section-content" style="position: relative; z-index: 3;">';
    $template = [['acf/wrapper']];
    $allowed_blocks = ['acf/wrapper'];

        echo '<div class="team-members-top-content">';
                echo '<div class="team-members-inner">';
                    echo '<InnerBlocks template="' . esc_attr( wp_json_encode( $template ) ) . '" templateLock="false" />';
                echo '</div>';

                echo '<div class="team-members-filter">';
                        echo '<label for="department-filter">Filter by:</label>';

                        $terms = get_terms( array( 
                            'taxonomy' => 'department',
                            'hide_empty' => true,
                        ) );
                        
                        if(!empty($terms)) {
                            echo '<div class="filter">';
                                echo '<div class="select">';
                                    echo '<span>All Teams</span>';
                                    echo '<i class="fa fa-chevron-down"></i>';
                                echo '</div>';
                                echo '<input type="hidden" name="department">';
                                echo '<ul class="dropdown-menu">';
                                        echo '<li id="all" value="all-teams">All Teams</li>';
                                    foreach($terms as $term) {
                                        echo '<li id="department-'.$term->term_id.'" value="'.$term->slug.'">'.$term->name.'</li>';
                                    }
                                echo '</ul>';
                            echo '</div>';
                        }
                        
                echo '</div>';
        echo '</div>';

        echo '<div class="team-members-wrapper">';
            $team_members = get_posts([
                'post_type' => 'team-member',
                'post_status' => 'published',
                'numberposts' => '-1',
                'fields' => 'ids',
                'order' => 'ASC'    
            ]);
            
            foreach($team_members as $member) {
                $memberID = $member;

                $visibility = get_field('show_in_frontend', $memberID);

                $position = get_field('position', $memberID);
                $name = get_the_title($memberID);
                $headshot = get_the_post_thumbnail($memberID, 'full', array('class' => 'team-headshot'));
                $bio = get_the_content($memberID) ? get_the_content($memberID) : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque accumsan enim sed facilisis viverra. Sed ante elit, ultrices eu hendrerit sed, ornare tincidunt nulla. Aliquam ultricies vehicula porttitor. Aliquam hendrerit nibh vel efficitur egestas. Vivamus a felis congue, ultrices purus et, imperdiet felis. Sed venenatis at quam sed cursus. Nulla ut mauris massa. Aenean ut gravida libero. Duis eget lectus lacus. Integer ultrices augue vel purus luctus vehicula. Suspendisse venenatis eu ligula quis fermentum. Morbi elementum sodales dui vitae efficitur. Mauris nibh est, auctor quis dolor et, accumsan tempor quam.';
                $department = get_the_terms($memberID, 'department');

                if($visibility) {
                    echo '<div class="team-member">';
                        echo !empty($headshot) ? $headshot : '';
                        echo '<div class="team-member-info">';
                                echo !empty($name) ? '<h3 class="team-member-name">'.$name.'</h3>' : '';
                                echo !empty($name) ? '<span class="team-member-position">'.$position.'</span>' : '';
                                echo !empty($bio) ? '<a href="#" class="team-member-bio">Read More ></a>' : '';
                        echo '</div>';
                    echo '</div>';
                }


            }


        echo '</div>';
    echo '</div>';
echo '</section>';