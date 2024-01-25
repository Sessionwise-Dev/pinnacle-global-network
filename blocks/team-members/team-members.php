<?php


$id = !empty( $block['anchor'] ) ? $block['anchor'] : '';
$classes = isset( $block['className'] ) ? ' ' . $block['className'] : ''; 
$classes .= get_field( 'spacing_size' ) ? ' mt-' . get_field( 'spacing_size' ) : ' mt-md';

echo '<section ' . ( isset( $id ) ? 'id="' . $id . '" ' : '') . 'style="position: relative;" class="team-members' . $classes . '">';
    echo is_admin() ? '<div class="admin-block-label">Team Members</div>' : '';    
    $template = [['acf/wrapper']];
    $allowed_blocks = ['acf/wrapper'];
        if( get_field( 'show_filtering' ) ):
        echo '<div class="team-members-top-content">';
                echo '<div class="team-members-inner">';
                    echo '<InnerBlocks template="' . esc_attr( wp_json_encode( $template ) ) . '" templateLock="false" />';
                echo '</div>';

                echo '<div class="team-members-filter">';
                        echo '<label for="department-filter">Filter by:</label>';

                        $terms = get_field( 'specify_category' );
                        
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
                                        $term_obj = get_term_by( 'term_id', $term, 'department' );
                                        echo '<li id="department-'.$term_obj->term_id.'" value="'.$term_obj->slug.'">'.$term_obj->name.'</li>';
                                    }
                                echo '</ul>';
                            echo '</div>';
                        }
                        
                echo '</div>';
        echo '</div>';
        endif;

        echo '<div class="team-members-wrapper">';
        
            $team_members_args = [
                'post_type' => 'team-member',
                'post_status' => 'published',
                'numberposts' => '-1',
                'fields' => 'ids',
                'orderby' => 'menu_order',
                'order' => 'ASC'    
            ];

            if( get_field( 'specify_category' ) ):
                $team_members_args['tax_query'] = [
                    [
                        'taxonomy' => 'department',
                        'field' => 'term_id',
                        'terms' => get_field( 'specify_category' )
                    ]
                ];
            endif;

            $team_members = get_posts( $team_members_args );

            $initialColumns = 5;

            $addGapCount = $initialColumns - (count($team_members) % $initialColumns);
            
            foreach($team_members as $member) {
                $memberID = $member;

                $visibility = get_field('show_in_frontend', $memberID);

                $position = get_field('position', $memberID);
                $name = get_the_title($memberID);
                $headshot = get_the_post_thumbnail($memberID, 'full', array('class' => 'team-headshot'));

                $memberPost = get_post($memberID);
                $bio = $memberPost->post_content ?: '';
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
echo '</section>';