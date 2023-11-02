<?php


$id = !empty( $block['anchor'] ) ? $block['anchor'] : '';

$classes = isset( $block['className'] ) ? ' ' . $block['className'] : ''; 
$classes .= get_field( 'section_vertical_padding' ) ? ' ' . get_field( 'section_vertical_padding' ) : ' container-y-pad';
$color = ' background-color:' . get_field( 'background_color' ) . ';';

$randomID = rand(0000, 9999);


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
                                echo '<input class="department-selector" type="hidden" name="department" value="all">';
                                echo '<ul class="dropdown-menu">';
                                        echo '<li value="all">All Teams</li>';
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

            $initialColumns = 5;

            $addGapCount = $initialColumns - (count($team_members) % $initialColumns);
            
            foreach($team_members as $member) {
                $memberID = $member;

                $visibility = get_field('show_in_frontend', $memberID);

                $position = get_field('position', $memberID);
                $name = get_the_title($memberID);
                $headshot = get_the_post_thumbnail($memberID, 'full', array('class' => 'team-headshot'));

                $memberPost = get_post($memberID);
                $bio = $memberPost->post_content ? $memberPost->post_content : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque accumsan enim sed facilisis viverra. Sed ante elit, ultrices eu hendrerit sed, ornare tincidunt nulla. Aliquam ultricies vehicula porttitor. Aliquam hendrerit nibh vel efficitur egestas. Vivamus a felis congue, ultrices purus et, imperdiet felis. Sed venenatis at quam sed cursus. Nulla ut mauris massa. Aenean ut gravida libero. Duis eget lectus lacus. Integer ultrices augue vel purus luctus vehicula. Suspendisse venenatis eu ligula quis fermentum. Morbi elementum sodales dui vitae efficitur. Mauris nibh est, auctor quis dolor et, accumsan tempor quam.';
                $departments = get_the_terms($memberID, 'department');

                $dept_class = '';

                foreach($departments as $department) {
                    $dept_class .= ' '. $department->slug;
                }

                if($visibility) {
                    echo '<div class="mix team-member'.$dept_class.'">';
                        echo !empty($headshot) ? $headshot : '';
                        echo '<div class="team-member-info">';
                                echo !empty($name) ? '<h3 class="team-member-name">'.$name.'</h3>' : '';
                                echo !empty($name) ? '<span class="team-member-position">'.$position.'</span>' : '';
                                echo !empty($bio) ? '<a href="#" class="team-member-bio custom-modal-trigger" data-modal="member-'.$memberID.'">Read More ></a>' : '';
                        echo '</div>';
                    echo '</div>';

                    echo '<div class="custom-modal member-modal" data-modal="member-'.$memberID.'">';
                        echo '<div class="custom-modal-inner">';
                            echo '<button class="custom-modal-close"><i class="fas fa-times"></i></button>';
                            echo '<div class="member-modal-inner">';
                                echo '<div class="member-modal-info">';
                                    echo !empty($headshot) ? $headshot : '';
                                    echo !empty($name) ? '<h3 class="team-member-name">'.$name.'</h3>' : '';
                                    echo !empty($name) ? '<span class="team-member-position">'.$position.'</span>' : '';
                                echo '</div>';
                                echo !empty($bio) ? '<div class="team-member-bio">'.$bio.'</div>' : '';      
                            echo '</div>'; 
                        echo '</div>';
                    echo '</div>';
                }
            }

            for($i = 0; $i < $addGapCount; $i++) {
                echo '<div class="gap"></div>';
            }


        echo '</div>';
    echo '</div>';
echo '</section>';